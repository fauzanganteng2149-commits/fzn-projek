<?php
include "koneksi.php";

header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=data_barang.csv");

$output = fopen("php://output", "w");

fputcsv($output, [
    "ID", "Nama Barang", "Kategori",
    "Jumlah", "Lokasi", "Kondisi"
], ";");

$data = mysqli_query($conn, "SELECT * FROM barang");

while ($row = mysqli_fetch_assoc($data)) {
    fputcsv($output, [
        $row['id'],
        $row['nama_barang'],
        $row['kategori'],
        $row['jumlah'],
        $row['lokasi'],
        $row['kondisi']
    ], ";");
}

fclose($output);
exit;
?>