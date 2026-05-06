<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
$row = mysqli_fetch_assoc($data);
?>

<h2>Edit Data</h2>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">

    Nama: <input type="text" name="nama" value="<?= $row['nama']; ?>"><br><br>
    NPM: <input type="text" name="npm" value="<?= $row['npm']; ?>"><br><br>

    <button type="submit">Update</button>
</form>