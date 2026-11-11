<?php
include "koneksi.php";

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string(
        $conn, $_POST['nama_barang']
    );
    $kategori = mysqli_real_escape_string(
        $conn, $_POST['kategori']
    );
    $jumlah = (int) $_POST['jumlah'];
    $lokasi = mysqli_real_escape_string(
        $conn, $_POST['lokasi']
    );
    $kondisi = mysqli_real_escape_string(
        $conn, $_POST['kondisi']
    );

    mysqli_query($conn, "INSERT INTO barang
        (nama_barang, kategori, jumlah, lokasi, kondisi)
        VALUES ('$nama', '$kategori', $jumlah,
        '$lokasi', '$kondisi')");

    header("Location: index.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
$total = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM barang")
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Barang Rumah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>RumahKu</h1>
    <p>Sistem Pendataan Barang Rumah Tangga</p>
</header>

<main>
    <section class="statistik">
        <div class="card">
            <h3>Total Jenis Barang</h3>
            <h2><?= $total['total']; ?></h2>
        </div>
        <div class="card">
            <h3>Pengelolaan Barang</h3>
            <p>Data tersimpan di database</p>
        </div>
    </section>

    <section class="form-box">
        <h2>Tambah Barang</h2>

        <form method="POST">
            <input type="text" name="nama_barang"
                placeholder="Nama barang" required>

            <select name="kategori" required>
                <option value="">Pilih kategori</option>
                <option>Alat Kebersihan</option>
                <option>Peralatan Dapur</option>
                <option>Elektronik</option>
                <option>Perlengkapan Rumah</option>
            </select>

            <input type="number" name="jumlah"
                placeholder="Jumlah barang" min="1" required>

            <input type="text" name="lokasi"
                placeholder="Lokasi barang" required>

            <select name="kondisi" required>
                <option value="">Pilih kondisi</option>
                <option>Baik</option>
                <option>Rusak</option>
                <option>Perlu Perbaikan</option>
            </select>

            <button type="submit" name="tambah">
                + Tambah Barang
            </button>
        </form>
    </section>

    <section class="tabel-box">
        <div class="judul-tabel">
            <h2>Daftar Barang</h2>
            <a href="export.php" class="btn-export">
                Ekspor Excel
            </a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Lokasi</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?= htmlspecialchars($row['kategori']); ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= htmlspecialchars($row['lokasi']); ?></td>
                        <td><?= htmlspecialchars($row['kondisi']); ?></td>
                        <td class="aksi">
                            <a href="edit.php?id=<?= $row['id']; ?>"
                                class="btn-edit">Edit</a>

                            <a href="hapus.php?id=<?= $row['id']; ?>"
                                class="btn-hapus"
                                onclick="return confirm('Hapus barang ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2026 RumahKu - Pendataan Barang Rumah Tangga</p>
</footer>

</body>
</html>