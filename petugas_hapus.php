<?php
include '../koneksi.php';
session_start();

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['pesan'] = ['danger', 'ID petugas tidak valid.'];
    header("Location: petugas.php");
    exit;
}

// Jangan biarkan admin menghapus dirinya sendiri (opsional)
if ($_SESSION['admin_id'] == $id) {
    $_SESSION['pesan'] = ['danger', 'Tidak bisa menghapus diri sendiri!'];
    header("Location: petugas.php");
    exit;
}

$hapus = mysqli_query($koneksi, "DELETE FROM petugas WHERE id = '$id'");

if ($hapus) {
    $_SESSION['pesan'] = ['success', 'Petugas berhasil dihapus!'];
} else {
    $_SESSION['pesan'] = ['danger', 'Gagal menghapus data!'];
}

header("Location: petugas.php");
exit;
