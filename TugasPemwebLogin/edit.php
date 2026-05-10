<?php
session_start();

if (!isset($_SESSION['nama']) || $_SESSION['nama'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}
require 'koneksi.php';
$id = (int)$_GET['id'];
$pesan = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_baru     = trim($_POST['nama']);
    $password_baru = $_POST['password_baru'];
    if (empty($nama_baru)) {
        $pesan = "Nama tidak boleh kosong.";
    } else {
        if (!empty($password_baru)) {
            $hashed = password_hash($password_baru, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE users SET nama = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nama_baru, $hashed, $id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET nama = ? WHERE id = ?");
            $stmt->bind_param("si", $nama_baru, $id);
        }

        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            $pesan = "Gagal menyimpan: " . $stmt->error;
        }
        $stmt->close();
    }
}
$stmt_get = $conn->prepare("SELECT nama FROM users WHERE id = ?");
$stmt_get->bind_param("i", $id);
$stmt_get->execute();
$stmt_get->bind_result($nama_lama);


if (!$stmt_get->fetch()) {
    header("Location: dashboard.php");
    exit();
}
$stmt_get->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pengguna</title>
</head>
<body>

    <h2>Edit Data Pengguna</h2>

    <?php if ($pesan != "") echo "<p style='color:red;'>$pesan</p>"; ?>

    <form method="POST" action="">
        <label>Nama Pengguna:</label><br>
        <input type="text" name="nama"
               value="<?php echo htmlspecialchars($nama_lama); ?>" required><br><br>

        <label>Password Baru:</label><br>
        <input type="password" name="password_baru"
               placeholder="Masukkan password baru"><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="dashboard.php"><button>Batal</button></a>
</body>
</html>
