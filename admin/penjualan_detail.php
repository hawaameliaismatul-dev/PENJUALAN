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
        </div><?php
include '../koneksi.php';

$dari   = $_GET['dari'];
$sampai = $_GET['sampai'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Penjualan</title>
    <style>
        body{
            font-family: Arial, sans-serif;
        }
        h2{
            text-align: center;
            margin-bottom: 5px;
        }
        .periode{
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td{
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th{
            background: #f0f0f0;
        }
        .total{
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>LAPORAN DATA PENJUALAN</h2>
<div class="periode">
    Periode: <?= date('d-m-Y', strtotime($dari)); ?> s/d <?= date('d-m-Y', strtotime($sampai)); ?>
</div>

<table>
    <tr>
        <th>No</th>
        <th>No Invoice</th>
        <th>Tanggal</th>
        <th>Nama Kasir</th>
        <th>Nama Barang</th>
        <th>Harga Jual</th>
        <th>Total Harga</th>
    </tr>

<?php
$no = 1;
$grand_total = 0;

$data = mysqli_query($koneksi,"
    SELECT p.*, b.nama_barang, b.harga_jual, u.user_nama
    FROM penjualan p
    JOIN barang b ON p.id_barang = b.id_barang
    JOIN user u ON p.user_id = u.user_id
    WHERE DATE(p.tgl_jual) BETWEEN '$dari' AND '$sampai'
    ORDER BY p.tgl_jual ASC
");

while($d = mysqli_fetch_array($data)){
    $grand_total += $d['total_harga'];
?>
<tr>
    <td><?= $no++; ?></td>
    <td>TRX<?= $d['id_jual']; ?></td>
    <td><?= date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
    <td><?= $d['user_nama']; ?></td>
    <td><?= $d['nama_barang']; ?></td>
    <td>Rp <?= number_format($d['harga_jual']); ?></td>
    <td>Rp <?= number_format($d['total_harga']); ?></td>
</tr>
<?php } ?>

<tr class="total">
    <td colspan="6">TOTAL KESELURUHAN</td>
    <td>Rp <?= number_format($grand_total); ?></td>
</tr>
</table>

<script>
    window.print();
</script>

</body>
</html>


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