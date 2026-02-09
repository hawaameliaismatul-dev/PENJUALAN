<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Data Barang</b></h4>
        </div>
        <div class="panel-body">

            <a href="barang_tambah.php" class="btn btn-sm btn-info pull-right">
                Tambah Barang
            </a>

            <br><br>

            <table class="table table-bordered table-striped">
                <tr>
                    <th width="15%">ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th width="20%">OPSI</th>
                </tr>

                <?php
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM barang");
                while ($d = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td><?= $d['id_barang']; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td><?= $d['harga_beli']; ?></td>
                        <td><?= $d['harga_jual']; ?></td>
                        <td><?= $d['stok']; ?></td>
                        <td>
                            <a href="barang_edit.php?id=<?= $d['id_barang']; ?>" 
                               class="btn btn-sm btn-info">
                                Edit
                            </a>

                            <a href="barang_hapus.php?id=<?= $d['id_barang']; ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</div>
