<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];

// Ambil data penjualan (header)
$p = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT penjualan.*, user.username 
    FROM penjualan 
    JOIN user ON penjualan.user_id = user.user_id
    WHERE id_jual='$id'
"));
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Detail Penjualan</b></h4>
        </div>

        <div class="panel-body">

            <a href="penjualan.php" class="btn btn-sm btn-info pull-right">Kembali</a>
            <br><br>

            <table class="table table-bordered">
                <tr>
                    <th width="20%">ID Transaksi</th>
                    <td><?= $p['id_jual']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= $p['tgl_jual']; ?></td>
                </tr>
                <tr>
                    <th>Kasir</th>
                    <td><?= $p['username']; ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td><b>Rp <?= number_format($p['total_harga']); ?></b></td>
                </tr>
            </table>

            <h4>Daftar Barang Dibeli</h4>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $d = mysqli_query($koneksi,"
                    SELECT penjualan_detail.*, barang.nama_barang
                    FROM penjualan_detail
                    JOIN barang ON penjualan_detail.id_barang = barang.id_barang
                    WHERE id_jual='$id'
                ");

                while($x = mysqli_fetch_array($d)){
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $x['nama_barang']; ?></td>
                        <td><?= $x['jumlah']; ?></td>
                        <td>Rp <?= number_format($x['harga']); ?></td>
                        <td>Rp <?= number_format($x['subtotal']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>