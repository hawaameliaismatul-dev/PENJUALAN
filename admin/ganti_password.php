<?php
include 'header.php';
include '../koneksi.php';

if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:../index.php?pesan=belum_login");
    exit();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $pass_lama = md5($_POST['pass_lama']);
    $pass_baru = md5($_POST['pass_baru']);
    $user_id   = $_SESSION['user_id'];

    $cek = mysqli_query($koneksi,"
        select * from user 
        where user_id='$user_id' 
        and password='$pass_lama'
    ");

    if(mysqli_num_rows($cek) > 0){
        mysqli_query($koneksi,"
            update user 
            set password='$pass_baru' 
            where user_id='$user_id'
        ");
        echo "<script>alert('Password berhasil diubah'); window.location='ganti_password.php';</script>";
    } else {
        echo "<script>alert('Password lama salah'); window.location='ganti_password.php';</script>";
    }
}
?>

<div class="container">
    <br><br><br>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Ganti Password</b></h4>
        </div>

        <div class="panel-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" name="pass_lama"
                           class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="pass_baru"
                           class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-save"></i> Simpan
                </button>

                <a href="index.php" class="btn btn-default">
                    <i class="glyphicon glyphicon-arrow-left"></i> Batal
                </a>
            </form>
        </div>
    </div>
</div>
