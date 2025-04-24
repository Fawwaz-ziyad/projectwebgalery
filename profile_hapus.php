<?php
session_start();
include '../koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['pesan'] = ['danger', 'ID profile tidak valid.'];
    header("Location: index.php");
    exit;
}

$hapus = mysqli_query($koneksi, "DELETE FROM profile WHERE id = '$id'");

if ($hapus) {
    $_SESSION['pesan'] = ['success', 'Data profile berhasil dihapus!'];
} else {
    $_SESSION['pesan'] = ['danger', 'Gagal menghapus data!'];
}

header("Location: profile.php");
exit;
