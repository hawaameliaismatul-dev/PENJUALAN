<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Filter Laporan Penjualan</b></h4>
        </div>

        <div class="panel-body">
            <form action="" method="get">
                <table class="table table-bordered">
                    <tr>
                        <th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th width="1%"></th>
                    </tr>
                    <tr>
                        <td><input type="date" name="tgl_dari" class="form-control" required></td>
                        <td><input type="date" name="tgl_sampai" class="form-control" required></td>
                        <td><input type="submit" class="btn btn-primary" value="Filter"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php
if(isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])){
    $dari   = $_GET['tgl_dari'];
    $sampai = $_GET['tgl_sampai'];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            Laporan Penjualan dari <b><?= $dari ?></b> sampai <b><?= $sampai ?></b>
        </h4>
    </div>

    <div class="panel-body">

        <a target="_blank"
           href="laporan_cetak.php?dari=<?= $dari ?>&sampai=<?= $sampai ?>"
           class="btn btn-success">
           <i class="glyphicon glyphicon-print"></i> Cetak
        </a>

        <br><br>

        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Barang</th>
                <th>Total</th>
            </tr>

<?php
$no = 1;
$data = mysqli_query($koneksi,"
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        u.user_nama,
        GROUP_CONCAT(b.nama_barang SEPARATOR ', ') AS barang
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    JOIN penjualan_detail d ON p.id_jual = d.id_jual
    JOIN barang b ON d.id_barang = b.id_barang
    WHERE DATE(p.tgl_jual) BETWEEN '$dari' AND '$sampai'
    GROUP BY p.id_jual
    ORDER BY p.id_jual DESC
");

while($d = mysqli_fetch_assoc($data)){
?>
            <tr>
                <td><?= $no++; ?></td>
                <td>INV-<?= $d['id_jual']; ?></td>
                <td><?= date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                <td><?= $d['user_nama']; ?></td>
                <td><?= $d['barang']; ?></td>
                <td>Rp <?= number_format($d['total_harga']); ?></td>
            </tr>
<?php } ?>

        </table>
    </div>
</div>

<?php } ?>
</div>