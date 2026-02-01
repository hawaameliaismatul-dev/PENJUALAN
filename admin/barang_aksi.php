<?php
include '../koneksi.php';

$nama_barang = $_POST['nama_barang'];
$harga_beli  = $_POST['harga_beli'];
$harga_jual  = $_POST['harga_jual'];
$stok        = $_POST['stok'];

mysqli_query($koneksi, "
    INSERT INTO barang (nama_barang, harga_beli, harga_jual, stok)
    VALUES ('$nama_barang', '$harga_beli', '$harga_jual', '$stok')
");

header("location:barang.php");
?>
