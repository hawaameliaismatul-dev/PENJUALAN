<?php
include '../koneksi.php';

$username    = $_POST['username'];
$password    = $_POST['password'];
$user_nama   = $_POST['user_nama'];
$user_status = $_POST['user_status'];

mysqli_query($koneksi, "
    INSERT INTO user (username, password, user_nama, user_status)
    VALUES ('$username', '$password', '$user_nama', '$user_status')
");

header("location:user.php");
