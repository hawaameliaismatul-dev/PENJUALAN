<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM user WHERE username='$username' AND password='$password'"
);

if (mysqli_num_rows($query) > 0) {
    $d = mysqli_fetch_assoc($query);

    $_SESSION['user_id'] = $d['user_id'];
    $_SESSION['user_nama'] = $d['user_nama'];
    $_SESSION['username'] = $d['username'];
    $_SESSION['user_status'] = $d['user_status'];
    $_SESSION['status'] = "login";

    if ($d['user_status'] == 1) {
        header("location:admin/index.php");
        exit;
    } elseif ($d['user_status'] == 2) {
        header("location:kasir/index.php");
        exit;
    }
} else {
    header("location:index.php?pesan=gagal");
    exit;
}