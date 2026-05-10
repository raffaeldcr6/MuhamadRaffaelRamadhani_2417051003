<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: auth.php");
    exit();
}

$nama_user = $_SESSION['nama'];

if (isset($_GET['hapus']) && $nama_user === 'admin') {
    require 'koneksi.php';

    $id_hapus = (int)$_GET['hapus']; 

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);   
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h2>Selamat Datang, <?php echo htmlspecialchars($nama_user); ?>!</h2>
    <a href="logout.php"><button>Logout</button></a>

    <?php
    if ($nama_user === 'admin'):
        require 'koneksi.php';

        $result = $conn->query("SELECT id, nama FROM users ORDER BY id DESC");
    ?>

        <h3>Menu Admin: Kelola Pengguna</h3>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">
                            <button>Edit</button>
                        </a>

                        <a href="dashboard.php?hapus=<?php echo $row['id']; ?>"
                           onclick="return confirm('Yakin ingin menghapus user ini?')">
                            <button>Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php
    
    else:
    ?>
        <p>Selamat datang di dashboard! Kamu login sebagai user reguler.</p>
    <?php endif; ?>

</body>
</html>
