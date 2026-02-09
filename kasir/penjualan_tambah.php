<?php 
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Tambah Penjualan</b></h4>
        </div>
        <div class="panel-body">


            <form method="post" action="penjualan_aksi.php">

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tgl_jual" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Kasir</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">- Pilih Kasir -</option>
                        <?php
                        $u = mysqli_query($koneksi,"SELECT * FROM user");
                        while($us=mysqli_fetch_array($u)){
                        ?>
                        <option value="<?= $us['user_id']; ?>">
                            <?= $us['user_nama']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <hr>
                <h4>Daftar Barang</h4>

                <table class="table table-bordered">
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                    </tr>

                    <?php for($i=0;$i<5;$i++){ ?>
                    <tr>
                        <td>
                            <select name="id_barang[]" class="form-control">
                                <option value="">- Pilih Barang -</option>
                                <?php
                                $b = mysqli_query($koneksi,"SELECT * FROM barang");
                                while($br=mysqli_fetch_array($b)){
                                ?>
                                <option value="<?= $br['id_barang']; ?>">
                                    <?= $br['nama_barang']; ?> (stok: <?= $br['stok']; ?>)
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="jumlah[]" class="form-control" min="1">
                        </td>
                    </tr>
                    <?php } ?>
                </table>

                <input type="submit" value="Simpan Penjualan" class="btn btn-primary">
                <a href="penjualan.php" class="btn btn-default">Kembali</a>

            </form>
        </div>
    </div>
</div>