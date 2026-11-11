<?php
include "koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
}

header("Location: index.php");
exit;
?>