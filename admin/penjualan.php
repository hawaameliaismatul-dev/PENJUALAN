<?php 
include '../koneksi.php';
include 'header.php';

$data = mysqli_query($koneksi,"
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        u.user_nama
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    ORDER BY p.id_jual DESC
");
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Penjualan</h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Jual</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total Harga</th>
                        <th width="12%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($d = mysqli_fetch_assoc($data)){
                    ?>
                    <tr>
                        <td><?= $d['id_jual']; ?></td>
                        <td><?= date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                        <td><?= $d['user_nama']; ?></td>
                        <td>Rp <?= number_format($d['total_harga']); ?></td>
                        <td class="text-center">
                            <a href="penjualan_detail.php?id=<?= $d['id_jual']; ?>" 
                               class="btn btn-info btn-xs" style="margin-right:5px;">Detail</a>

                            <a href="penjualan_hapus.php?id=<?= $d['id_jual']; ?>"
                               onclick="return confirm('Yakin ingin menghapus riwayat penjualan ini?')"
                               class="btn btn-danger btn-xs">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            
        </div>
    </div>
</div>
