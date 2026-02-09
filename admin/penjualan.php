<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Data Penjualan</b></h4>
        </div>

        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Barang</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th width="12%">Opsi</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $query = mysqli_query($koneksi,"
                    SELECT 
                        p.id_jual,
                        p.tgl_jual,
                        p.total_harga,
                        u.user_nama,
                        GROUP_CONCAT(b.nama_barang SEPARATOR ', ') AS daftar_barang,
                        SUM(d.jumlah) AS total_item
                    FROM penjualan p
                    JOIN user u ON p.user_id = u.user_id
                    JOIN penjualan_detail d ON p.id_jual = d.id_jual
                    JOIN barang b ON d.id_barang = b.id_barang
                    GROUP BY p.id_jual
                    ORDER BY p.id_jual DESC
                ");

                $no = 1;
                while($d = mysqli_fetch_assoc($query)){
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>INVOICE-<?= $d['id_jual']; ?></td>
                        <td><?= date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                        <td><?= $d['user_nama']; ?></td>
                        <td><?= $d['daftar_barang']; ?></td>
                        <td><?= $d['total_item']; ?> item</td>
                        <td>Rp <?= number_format($d['total_harga']); ?></td>
                        <td class="text-center">

                            <a href="penjualan_invoice.php?id=<?= $d['id_jual']; ?>" 
                               class="btn btn-warning btn-xs">
                                Invoice
                                
                                <a href="penjualan_hapus.php?id=<?= $d['id_jual']; ?>" 
                               class="btn btn-danger btn-xs">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
