<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit;
}

if (!isset($_SESSION['user_status']) || $_SESSION['user_status'] != 1) {
    header("Location: ../index.php?pesan=belum_login");
    exit;
}

$page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Penjualan</title>

    <link rel="stylesheet" type="text/css" href="../aset/css/bootstrap.css">
    <script type="text/javascript" src="../aset/js/jquery.js"></script>
    <script type="text/javascript" src="../aset/js/bootstrap.js"></script>
</head>

<body style="background:#f0f0f0;">

<nav class="navbar navbar-inverse" style="border-radius:0;">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#navbar-admin"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="index.php">
                <i class="glyphicon glyphicon-shopping-cart"></i> PENJUALAN
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-admin">

            <ul class="nav navbar-nav">
                <li class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                    <a href="index.php">
                        <i class="glyphicon glyphicon-home"></i> Home
                    </a>
                </li>

                <li class="<?= ($page == 'user.php') ? 'active' : '' ?>">
                    <a href="user.php">
                        <i class="glyphicon glyphicon-user"></i> User
                    </a>
                </li>

                <li class="<?= ($page == 'barang.php') ? 'active' : '' ?>">
                    <a href="barang.php">
                        <i class="glyphicon glyphicon-inbox"></i> Barang
                    </a>
                </li>

                <li class="<?= ($page == 'penjualan.php') ? 'active' : '' ?>">
                    <a href="penjualan.php">
                        <i class="glyphicon glyphicon-shopping-cart"></i> Penjualan
                    </a>
                </li>

                <li class="<?= ($page == 'laporan.php') ? 'active' : '' ?>">
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
                    <a href="../logout.php"
                       onclick="return confirm('Yakin ingin logout?')">
                        <i class="glyphicon glyphicon-log-out"></i> Logout
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p style="color:white; padding:15px; margin:0;">
                        <b>Halo, <?= $_SESSION['username']; ?></b>
                    </p>
                </li>
            </ul>

        </div>
    </div>
</nav>
