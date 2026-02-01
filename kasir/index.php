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
                            <h3><?php echo mysqli_num_rows($hari); ?></h3>
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
            <h4><i class="glyphicon glyphicon-list-alt"></i> Riwayat Penjualan Terakhir</h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="5%">No</th>
                    <th>ID Jual</th>
                    <th>Barang</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                </tr>

                <?php
                $data = mysqli_query($koneksi,"SELECT penjualan.*, barang.nama_barang 
                                               FROM penjualan 
                                               JOIN barang ON penjualan.id_barang = barang.id_barang 
                                               WHERE penjualan.user_id = '$user_id' 
                                               ORDER BY penjualan.id_jual DESC 
                                               LIMIT 10");
                $no = 1;
                while ($d = mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['id_jual']; ?></td>
                        <td><?php echo $d['nama_barang']; ?></td>
                        <td><?php echo $d['tgl_jual']; ?></td>
                        <td><?php echo "Rp. " . number_format($d['total_harga']); ?></td>
                    </tr>
                <?php 
                } 
                ?>
            </table>
        </div>
    </div>

</div>
