<?php
include 'header.php';
include '../koneksi.php';

$user_id = $_SESSION['user_id'];
?>

<div class="container">

    <!-- WELCOME -->
    <div class="alert alert-info">
        <h4 style="margin:0;">
            <b>Selamat Datang!</b> <?php echo $_SESSION['username']; ?> di Dashboard Kasir
        </h4>
    </div>

    <?php
        $jual   = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE user_id='$user_id'");
        $today  = date('Y-m-d');
        $hari   = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE user_id='$user_id' AND DATE(tgl_jual)='$today'");
        $barang = mysqli_query($koneksi, "SELECT * FROM barang");
    ?>

    <!-- DASHBOARD -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-dashboard"></i> Dashboard</h4>
        </div>

        <div class="panel-body">
            <div class="row">

                <!-- TOTAL TRANSAKSI -->
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-shopping-cart" style="font-size:40px;"></i>
                            <h3><?php echo mysqli_num_rows($jual); ?></h3>
                            <p>Total Transaksi Anda</p>
                        </div>
                    </div>
                </div>

                <!-- PENJUALAN HARI INI -->
                <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-calendar" style="font-size:40px;"></i>
                            <h3><?php echo mysqli_num_rows($jual); ?></h3>
                            <p>Penjualan Hari Ini</p>
                        </div>
                    </div>
                </div>

                <!-- JUMLAH BARANG -->
                <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-th-large" style="font-size:40px;"></i>
                            <h3><?php echo mysqli_num_rows($barang); ?></h3>
                            <p>Jumlah Barang</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

   <!-- RIWAYAT PENJUALAN -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            <i class="glyphicon glyphicon-list-alt"></i> Riwayat Penjualan Terbaru
        </h4>
    </div>

    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Jual</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Item</th>
                    <th>Total Harga</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $data = mysqli_query($koneksi,"
                SELECT 
                    p.id_jual,
                    p.tgl_jual,
                    p.total_harga,
                    u.user_nama,
                    GROUP_CONCAT(b.nama_barang SEPARATOR ', ') AS nama_barang,
                    SUM(d.jumlah) AS jumlah_item
                FROM penjualan p
                JOIN user u ON p.user_id = u.user_id
                JOIN penjualan_detail d ON p.id_jual = d.id_jual
                JOIN barang b ON d.id_barang = b.id_barang
                GROUP BY p.id_jual
                ORDER BY p.id_jual DESC
            ");

            $no = 1;
            while($d = mysqli_fetch_assoc($data)){
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>INVOICE-<?= $d['id_jual']; ?></td>
                    <td><?= date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                    <td><?= $d['user_nama']; ?></td>
                    <td><?= $d['nama_barang']; ?></td>
                    <td><?= $d['jumlah_item']; ?></td>
                    <td>Rp <?= number_format($d['total_harga']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
