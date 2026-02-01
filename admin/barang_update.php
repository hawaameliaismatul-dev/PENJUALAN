<?php
include '../koneksi.php';

$id_lama = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$harga_beli  = $_POST['harga_beli'];
$harga_jual  = $_POST['harga_jual'];
$stok        = $_POST['stok'];

mysqli_query($koneksi, "
    UPDATE barang SET
        nama_barang = '$nama_barang',
        harga_beli  = '$harga_beli',
        harga_jual  = '$harga_jual',
        stok        = '$stok'
    WHERE id_barang = '$id_lama'
");

header("location:barang.php");
?>