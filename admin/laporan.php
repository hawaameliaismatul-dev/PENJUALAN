<?php
include 'header.php';
include '../koneksi.php';

if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:../index.php?pesan=belum_login");
    exit();
}

// filter
$kasir_filter  = $_POST['kasir'] ?? '';
$tanggal_awal  = $_POST['tanggal_awal'] ?? '';
$tanggal_akhir = $_POST['tanggal_akhir'] ?? '';

$where = "1";
if($kasir_filter != '') $where .= " and p.user_id='$kasir_filter'";
if($tanggal_awal != '' && $tanggal_akhir != '')
    $where .= " and p.tgl_jual between '$tanggal_awal' and '$tanggal_akhir'";
?>

<div class="container">
    <br><br><br>

    <div class="alert alert-info text-center">
        <h4 style="margin:0;"><b>Laporan Penjualan</b></h4>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Filter Laporan</h4>
        </div>
        <div class="panel-body">
            <form method="POST">
                <div class="row">

                    <div class="col-md-4">
                        <label>Kasir</label>
                        <select name="kasir" class="form-control">
                            <option value="">-- Semua Kasir --</option>
                            <?php
                            $kasir = mysqli_query($koneksi,"select * from user where user_status=2");
                            while($k = mysqli_fetch_assoc($kasir)){
                                $sel = ($kasir_filter == $k['user_id']) ? 'selected' : '';
                                echo "<option value='{$k['user_id']}' $sel>{$k['user_nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggal_awal"
                               class="form-control"
                               value="<?= $tanggal_awal; ?>">
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir"
                               class="form-control"
                               value="<?= $tanggal_akhir; ?>">
                    </div>

                    <div class="col-md-2" style="margin-top:25px;">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="glyphicon glyphicon-filter"></i> Filter
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Hasil Laporan</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="5%">NO</th>
                    <th>ID Jual</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Jual</th>
                    <th>Total Harga</th>
                    <th>Kasir</th>
                </tr>

                <?php
                $no = 1;
                $grand_total = 0;

                $data = mysqli_query($koneksi,"
                    select p.*, b.nama_barang, b.harga_jual, u.user_nama 
                    from penjualan p 
                    join barang b on p.id_barang = b.id_barang 
                    join user u on p.user_id = u.user_id 
                    where $where 
                    order by p.id_jual desc
                ");

                while($d = mysqli_fetch_assoc($data)){
                    $grand_total += $d['total_harga'];
                ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td>JUAL-<?= $d['id_jual']; ?></td>
                    <td><?= $d['tgl_jual']; ?></td>
                    <td><?= $d['nama_barang']; ?></td>
                    <td align="center"><?= $d['jumlah_jual']; ?></td>
                    <td>Rp <?= number_format($d['harga_jual']); ?></td>
                    <td>Rp <?= number_format($d['total_harga']); ?></td>
                    <td><?= $d['user_nama']; ?></td>
                </tr>
                <?php } ?>

                <tr>
                    <th colspan="6" style="text-align:right;">Grand Total</th>
                    <th colspan="2">Rp <?= number_format($grand_total); ?></th>
                </tr>

            </table>
        </div>
    </div>

</div>
