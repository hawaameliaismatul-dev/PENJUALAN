<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi,"SELECT penjualan.*, barang.nama_barang, barang.harga_jual FROM penjualan JOIN barang ON penjualan.id_barang=barang.id_barang WHERE id_jual='$id'"));
$jumlah_lama = $data['total_harga'] / $data['harga_jual'];
?>

<form action="penjualan_aksi.php" method="post">
<input type="hidden" name="id_jual" value="<?= $data['id_jual']; ?>">
<input type="hidden" name="id_barang" value="<?= $data['id_barang']; ?>">

<div class="form-group">
    <label>Barang</label>
    <input type="text" class="form-control" value="<?= $data['nama_barang']; ?>" readonly>
</div>

<div class="form-group">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" min="1" value="<?= $jumlah_lama; ?>" required>
</div>

<input type="submit" name="edit" value="Update" class="btn btn-primary">
<a href="penjualan.php" class="btn btn-default">Batal</a>
</form>