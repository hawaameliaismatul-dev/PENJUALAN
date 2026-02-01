<?php
    include '../koneksi.php';
    $id=$_GET['id'];
    mysqli_query($koneksi,"DELETE FROM barang WHERE id_barang='$id'");
    echo "<script>alert('Data akan dihapus?');window.location.href='barang.php'</script>";
?>