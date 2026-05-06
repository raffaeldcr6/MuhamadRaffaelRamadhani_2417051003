<?php include 'koneksi.php'; ?>

<h2>Data Mahasiswa</h2>

<a href="tambah.php">+ Tambah Data</a>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NPM</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa");

    while ($row = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['npm']; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
            <a href="hapus.php?id=<?= $row['id']; ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>