<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$npm = $_POST['npm'];

mysqli_query($conn, "UPDATE mahasiswa SET 
    nama='$nama',
    npm='$npm'
    WHERE id=$id
");

header("Location: index.php");
?>