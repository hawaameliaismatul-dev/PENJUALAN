<?php
include 'header.php';
include '../koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;
if($user_id == 0){
    echo "<script>alert('Silahkan login dulu');window.location='../index.php';</script>";
    exit();
}
?>

<div class="container">
<div class="panel panel-default">
<div class="panel-heading">
<h4><b>Riwayat Penjualan</b></h4>
</div>

<div class="panel-body">

<table class="table table-bordered table-striped">
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Barang</th>
    <th>Jumlah</th>
    <th>Total Harga</th>
    <th>Opsi</th>
</tr>

<?php
$data = mysqli_query($koneksi,"SELECT penjualan.*, barang.nama_barang, barang.harga_jual FROM penjualan JOIN barang ON penjualan.id_barang=barang.id_barang WHERE user_id='$user_id' ORDER BY id_jual DESC ");
$no=1;
while($d=mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['tgl_jual']; ?></td>
    <td><?= $d['nama_barang']; ?></td>
    <td><?= $d['total_harga'] / $d['harga_jual']; ?></td>
    <td>Rp <?= number_format($d['total_harga']); ?></td>
    <td>
    
        <a href="penjualan_edit.php?id=<?= $d['id_jual']; ?>" class="btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-pencil"></i> Edit
        </a>
    </td>
</tr>
<?php
 } 
 ?>

</table>

<a href="penjualan_tambah.php" class="btn btn-primary">
    + Transaksi Baru
</a>

</div>
</div>
</div>