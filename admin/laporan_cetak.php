<?php
include '../koneksi.php';

$dari   = $_GET['dari'];
$sampai = $_GET['sampai'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Penjualan</title>
    <style>
        body{
            font-family: Arial;
            font-size: 12px;
        }
        h2{
            text-align: center;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td{
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

<h2>LAPORAN PENJUALAN</h2>
<p style="text-align:center;">
    Periode : <b><?= $dari ?></b> s/d <b><?= $sampai ?></b>
</p>

<table>
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
$total_semua = 0;

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
    $total_semua += $d['total_harga'];
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

    <tr>
        <th colspan="5">TOTAL PENJUALAN</th>
        <th>Rp <?= number_format($total_semua); ?></th>
    </tr>
</table>

</body>
</html>
