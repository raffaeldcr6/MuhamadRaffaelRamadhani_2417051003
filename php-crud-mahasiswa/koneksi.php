<?php
$conn = mysqli_connect("localhost", "root", "", "kampus");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
