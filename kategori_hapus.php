<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$id = $_GET['id'];
if (mysqli_query($koneksi, "DELETE FROM kategori WHERE id = $id")) {
    $_SESSION['pesan'] = ['success', 'Kategori berhasil dihapus!'];
} else {
    $_SESSION['pesan'] = ['danger', 'Gagal menghapus kategori.'];
}
header("Location: kategori.php");
exit;
