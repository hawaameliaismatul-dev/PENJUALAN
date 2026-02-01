<?php
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><b>Tambah User Baru</b></h4>
            </div>
            <div class="panel-body">

                <form method="POST" action="user_aksi.php">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username"
                               class="form-control"
                               placeholder="Masukkan Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password"
                               class="form-control"
                               placeholder="Masukkan Password" required>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="user_nama"
                               class="form-control"
                               placeholder="Masukkan Nama" required>
                    </div>

                    <div class="form-group">
                        <label>Status User</label>
                        <select name="user_status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="1">1 - Admin</option>
                            <option value="2">2 - Kasir</option>
                        </select>
                    </div>

                    <br>
                    <input type="submit" class="btn btn-primary" value="Simpan">

                </form>

            </div>
        </div>
    </div>
</div>
