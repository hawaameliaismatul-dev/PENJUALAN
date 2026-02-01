<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$id'");
$d = mysqli_fetch_assoc($data);
?>

<div class="container">
    <br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b>Edit User</b></h4>
            </div>
            <div class="panel-body">

                <form method="POST" action="user_update.php">

                    <input type="hidden" name="user_id" value="<?php echo $d['user_id']; ?>">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control"
                               value="<?php echo $d['username']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Kosongkan jika tidak diubah">
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control"
                               value="<?php echo $d['user_nama']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Status User</label>
                        <select name="status" class="form-control" required>
                            <option value="1" <?php if($d['user_status']==1) echo "selected"; ?>>
                                1 - Admin
                            </option>
                            <option value="2" <?php if($d['user_status']==2) echo "selected"; ?>>
                                2 - Kasir
                            </option>
                        </select>
                    </div>

                    <br>
                    <input type="submit" class="btn btn-primary" value="Simpan">

                </form>

            </div>
        </div>
    </div>
</div>
