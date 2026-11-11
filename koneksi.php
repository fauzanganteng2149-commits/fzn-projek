<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "pendataan_barang"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>