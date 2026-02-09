<!DOCTYPE html>
<html>
<head>
    <title>Invoice Penjualan</title>
    <link rel="stylesheet" href="../aset/css/bootstrap.css">
    <style>
        body{
            font-family: monospace;
            background: #ededed;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }
        .invoice{
            width: 420px;
            background: #fff;
            padding: 18px;
            border: 2px dashed #333;
        }
        .text-center{text-align:center;}
        .text-right{text-align:right;}
        .line{
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .flex{
            display:flex;
            justify-content: space-between;
        }
        .small{
            font-size: 13px;
        }
    </style>
</head>
<body>

<?php
include '../koneksi.php';

$id = $_GET['id'];

/* === DATA HEADER INVOICE === */
$header = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        u.user_nama
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    WHERE p.id_jual = '$id'
"));
?>

<div class="invoice">

    <div class="text-center">
        <h4 style="margin:0;">MELIA MART</h4>
        <span class="small">Nota Penjualan Kasir</span>
    </div>

    <div class="line"></div>

    <div class="small">
        No : INV-<?= $header['id_jual']; ?><br>
        Tanggal : <?= date('d-m-Y H:i', strtotime($header['tgl_jual'])); ?><br>
        Kasir : <?= $header['user_nama']; ?>
    </div>

    <div class="line"></div>

    <?php
    /* === DATA DETAIL BARANG === */
    $detail = mysqli_query($koneksi,"
        SELECT 
            b.nama_barang,
            d.jumlah,
            d.harga
        FROM penjualan_detail d
        JOIN barang b ON d.id_barang = b.id_barang
        WHERE d.id_jual = '$id'
    ");

    while($d = mysqli_fetch_assoc($detail)){
    ?>
        <div class="small"><?= $d['nama_barang']; ?></div>
        <div class="flex small">
            <span><?= $d['jumlah']; ?> x Rp <?= number_format($d['harga']); ?></span>
            <span>Rp <?= number_format($d['jumlah'] * $d['harga']); ?></span>
        </div>
    <?php } ?>

    <div class="line"></div>

    <div class="flex">
        <b>Total Bayar</b>
        <b>Rp <?= number_format($header['total_harga']); ?></b>
    </div>

    <div class="line"></div>

    <div class="text-center small">
        *** TERIMA KASIH ***<br>
        Sistem Penjualan Melia
    </div>

</div>

<script>
    window.print();
</script>

</body>
</html>