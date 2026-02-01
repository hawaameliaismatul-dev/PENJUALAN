<?php
include '../koneksi.php';

// Ambil ID Jual dari URL
$id_jual = $_GET['id'] ?? 0;

if($id_jual == 0){
    echo "<script>alert('ID transaksi tidak valid'); window.location='penjualan.php';</script>";
    exit;
}

// Hapus detail terlebih dahulu
mysqli_query($koneksi, "DELETE FROM penjualan_detail WHERE id_jual = '$id_jual'");

// Hapus penjualan
mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_jual = '$id_jual'");

echo "<script>alert('Transaksi berhasil dihapus'); window.location='penjualan.php';</script>";
