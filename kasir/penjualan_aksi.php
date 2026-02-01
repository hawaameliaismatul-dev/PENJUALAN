<?php
include '../koneksi.php';
session_start();

/* TAMBAH */
if (isset($_POST['tambah'])) {

    $id_barang_array = $_POST['id_barang']; // array
    $jumlah_array    = $_POST['jumlah'];    // array
    $user_id         = $_SESSION['user_id'];
    $tgl             = date('Y-m-d');

    // loop semua barang yang dipilih
    for($i=0; $i < count($id_barang_array); $i++){
        $id_barang = $id_barang_array[$i];
        $jumlah    = $jumlah_array[$i];

        if($id_barang != "" && $jumlah != ""){
            $barang = mysqli_fetch_array(
                mysqli_query($koneksi,"SELECT * FROM barang WHERE id_barang='$id_barang'")
            );

            $total = $barang['harga_jual'] * $jumlah;

            // simpan ke penjualan
            mysqli_query($koneksi,"
                INSERT INTO penjualan 
                VALUES(NULL,'$id_barang','$tgl','$total','$user_id')
            ");

            // kurangi stok
            mysqli_query($koneksi,"
                UPDATE barang SET stok = stok - $jumlah 
                WHERE id_barang='$id_barang'
            ");
        }
    }

    header("location:penjualan.php");
}

/* EDIT */
if(isset($_POST['edit'])){
    $id_jual = $_POST['id_jual'];
    $jumlah  = $_POST['jumlah'];
    $id_barang = $_POST['id_barang'];

    $data = mysqli_fetch_array(mysqli_query($koneksi,"SELECT penjualan.*, barang.harga_jual 
        FROM penjualan JOIN barang ON penjualan.id_barang=barang.id_barang 
        WHERE id_jual='$id_jual'"));
    $jumlah_lama = $data['total_harga'] / $data['harga_jual'];

    mysqli_query($koneksi,"UPDATE barang SET stok=stok+$jumlah_lama WHERE id_barang='$id_barang'");

    $total_baru = $data['harga_jual'] * $jumlah;
    mysqli_query($koneksi,"UPDATE penjualan SET total_harga='$total_baru' WHERE id_jual='$id_jual'");

    mysqli_query($koneksi,"UPDATE barang SET stok=stok-$jumlah WHERE id_barang='$id_barang'");

    header("location:penjualan.php");
}