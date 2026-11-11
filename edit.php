<?php
include "koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    die("ID barang tidak valid.");
}

$result = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$barang = mysqli_fetch_assoc($result);

if (!$barang) {
    die("Barang tidak ditemukan.");
}

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $jumlah = (int) $_POST['jumlah'];
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $kondisi = mysqli_real_escape_string($conn, $_POST['kondisi']);

    mysqli_query($conn, "UPDATE barang SET
        nama_barang='$nama',
        kategori='$kategori',
        jumlah=$jumlah,
        lokasi='$lokasi',
        kondisi='$kondisi'
        WHERE id=$id");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Edit Barang</h1>
    <p>Perbarui data barang rumah tangga</p>
</header>

<main>
    <section class="form-box">
        <form method="POST">
            <input type="text" name="nama_barang"
                value="<?= htmlspecialchars($barang['nama_barang']); ?>" required>

            <input type="text" name="kategori"
                value="<?= htmlspecialchars($barang['kategori']); ?>" required>

            <input type="number" name="jumlah"
                value="<?= $barang['jumlah']; ?>" min="1" required>

            <input type="text" name="lokasi"
                value="<?= htmlspecialchars($barang['lokasi']); ?>" required>

            <input type="text" name="kondisi"
                value="<?= htmlspecialchars($barang['kondisi']); ?>" required>

            <button type="submit" name="update">Simpan Perubahan</button>
        </form>
        <br>
        <a href="index.php">Kembali</a>
    </section>
</main>
</body>
</html>