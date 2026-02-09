<?php
session_start();
include '../koneksi.php';

$tgl_jual = $_POST['tgl_jual'];
$user_id  = $_POST['user_id'];

$id_barang = $_POST['id_barang'];
$jumlah    = $_POST['jumlah'];

/* ===============================
   1. BUAT 1 INVOICE (penjualan)
================================ */
mysqli_query($koneksi,"
    INSERT INTO penjualan (tgl_jual, total_harga, user_id)
    VALUES ('$tgl_jual', 0, '$user_id')
");

$id_jual = mysqli_insert_id($koneksi);
$total_semua = 0;

/* ===============================
   2. SIMPAN DETAIL BARANG
================================ */
for($i = 0; $i < count($id_barang); $i++){

    if($id_barang[$i] != "" && $jumlah[$i] > 0){

        $barang = mysqli_fetch_assoc(mysqli_query($koneksi,
            "SELECT * FROM barang WHERE id_barang='$id_barang[$i]'"));

        $harga = $barang['harga_jual'];
        $stok  = $barang['stok'];

        if($stok < $jumlah[$i]){
            echo "<script>alert('Stok ".$barang['nama_barang']." tidak cukup');history.back();</script>";
            exit;
        }

        $subtotal = $harga * $jumlah[$i];
        $total_semua += $subtotal;

        // simpan ke penjualan_detail
        mysqli_query($koneksi,"
            INSERT INTO penjualan_detail
            (id_jual, id_barang, jumlah, harga, subtotal)
            VALUES
            ('$id_jual', '$id_barang[$i]', '$jumlah[$i]', '$harga', '$subtotal')
        ");

        // kurangi stok
        mysqli_query($koneksi,"
            UPDATE barang
            SET stok = stok - $jumlah[$i]
            WHERE id_barang='$id_barang[$i]'
        ");
    }
}

/* ===============================
   3. UPDATE TOTAL INVOICE
================================ */
mysqli_query($koneksi,"
    UPDATE penjualan
    SET total_harga = '$total_semua'
    WHERE id_jual = '$id_jual'
");

echo "<script>alert('Transaksi berhasil disimpan');location='penjualan.php';</script>";
?>