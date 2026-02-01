<?php
session_start();

// cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit();
}

// cek role kasir
if ($_SESSION['user_status'] != 2) {
    header("location:../index.php?pesan=belum_login");
    exit();
}

// ambil nama file aktif
$halaman = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kasir</title>

    <link rel="stylesheet" type="text/css" href="../aset/css/bootstrap.css">
    <script type="text/javascript" src="../aset/js/jquery.js"></script>
    <script type="text/javascript" src="../aset/js/bootstrap.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse" style="border-radius:0;">
    <div class="container-fluid">

        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <i class="glyphicon glyphicon-shopping-cart"></i> PENJUALAN
            </a>
        </div>

        <ul class="nav navbar-nav">
            <li class="<?= $halaman=='index.php'?'active':'' ?>">
                <a href="index.php">
                    <i class="glyphicon glyphicon-home"></i> Dashboard
                </a>
            </li>

            <li class="<?= $halaman=='penjualan.php'?'active':'' ?>">
                <a href="penjualan.php">
                    <i class="glyphicon glyphicon-random"></i> Penjualan
                </a>
            </li>

            <li class="<?= $halaman=='laporan.php'?'active':'' ?>">
                <a href="laporan.php">
                    <i class="glyphicon glyphicon-list-alt"></i> Laporan
                </a>
            </li>

            <li class="dropdown <?= ($page == 'ganti_password.php') ? 'active' : '' ?>">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <i class="glyphicon glyphicon-wrench"></i> Pengaturan
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="ganti_password.php">
                                <i class="glyphicon glyphicon-lock"></i> Ganti Password
                            </a>
                        </li>
                    </ul>
            </li>

            <li>
                <a href="../logout.php">
                    <i class="glyphicon glyphicon-log-out"></i> Logout
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <p style="color:white; padding:15px; margin:0;">
                    Halo, <b><?= $_SESSION['username']; ?></b>
                </p>
            </li>
        </ul>

    </div>
</nav>