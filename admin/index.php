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

                <!-- JUMLAH USER -->
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-user text-danger"
                               style="font-size:40px;"></i>
                            <h3>
                                <?php
                                    $user = mysqli_query($koneksi,"SELECT * FROM user");
                                    echo mysqli_num_rows($user);
                                ?>
                            </h3>
                            <p>Jumlah User</p>
                        </div>
                    </div>
                </div>

                <!-- TOTAL BARANG -->
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-body text-center">
                            <i class="glyphicon glyphicon-inbox text-warning"
                               style="font-size:40px;"></i>
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
                            <i class="glyphicon glyphicon-ok-circle text-success"
                               style="font-size:40px;"></i>
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
                            <i class="glyphicon glyphicon-remove-circle text-info"
                               style="font-size:40px;"></i>
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

    <!-- RIWAYAT PENJUALAN -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-list-alt"></i> Riwayat Penjualan Terakhir
            </h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="1%">NO</th>
                    <th>ID Jual</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Total Harga</th>
                    <th>Nama Kasir</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $data = mysqli_query($koneksi,"
                        SELECT penjualan.*, barang.nama_barang, barang.harga_jual, user.user_nama
                        FROM penjualan
                        JOIN barang ON penjualan.id_barang = barang.id_barang
                        JOIN user ON penjualan.user_id = user.user_id
                        ORDER BY id_jual DESC
                        LIMIT 10
                    ");

                    $no = 1;
                    while($d = mysqli_fetch_assoc($data)){
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>JUAL-<?= $d['id_jual']; ?></td>
                        <td><?= $d['tgl_jual']; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td>Rp <?= number_format($d['total_harga']); ?></td>
                        <td><?= $d['user_nama']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
