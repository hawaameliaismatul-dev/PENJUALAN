<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">

    <!-- JUDUL -->
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom:0">
            <b>Selamat Datang Admin!</b> Sistem Penjualan Melia
        </h4>
    </div>

    <!-- DASHBOARD -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-dashboard"></i> Dashboard
            </h4>
        </div>

        <div class="panel-body">
            <div class="row">

                <!-- TOTAL USER -->
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-user text-danger" style="font-size:40px;"></i>
                            <h3>
                                <?php
                                $user = mysqli_query($koneksi,"SELECT * FROM user");
                                echo mysqli_num_rows($user);
                                ?>
                            </h3>
                            <p>Total User</p>
                        </div>
                    </div>
                </div>

                <!-- TOTAL BARANG -->
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-inbox text-warning" style="font-size:40px;"></i>
                            <h3>
                                <?php
                                $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                                echo mysqli_num_rows($barang);
                                ?>
                            </h3>
                            <p>Total Barang</p>
                        </div>
                    </div>
                </div>

                <!-- STOK TERSEDIA -->
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-ok-circle text-success" style="font-size:40px;"></i>
                            <h3>
                                <?php
                                $ready = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok > 0");
                                echo mysqli_num_rows($ready);
                                ?>
                            </h3>
                            <p>Stok Tersedia</p>
                        </div>
                    </div>
                </div>

                <!-- STOK HABIS -->
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-remove-circle text-info" style="font-size:40px;"></i>
                            <h3>
                                <?php
                                $habis = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok = 0");
                                echo mysqli_num_rows($habis);
                                ?>
                            </h3>
                            <p>Stok Habis</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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
