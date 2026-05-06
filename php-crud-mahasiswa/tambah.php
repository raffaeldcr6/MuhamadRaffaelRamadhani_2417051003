<?php include 'koneksi.php'; ?>

<h2>Tambah Data</h2>

<form method="POST">
    Nama: <input type="text" name="nama"><br><br>
    NPM: <input type="text" name="npm"><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $npm = $_POST['npm'];

    mysqli_query($conn, "INSERT INTO mahasiswa (nama, npm) VALUES ('$nama', '$npm')");

    header("Location: index.php");
}
?>