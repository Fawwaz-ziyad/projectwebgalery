<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Hapus foto yang terkait dulu
    $hapusFoto = mysqli_query($koneksi, "DELETE FROM foto WHERE galery_id='$id'");

    // Hapus galeri
    $hapusGaleri = mysqli_query($koneksi, "DELETE FROM galery WHERE id='$id'");

    if ($hapusFoto && $hapusGaleri) {
        $_SESSION['pesan'] = ['success', 'Galeri dan foto terkait berhasil dihapus!'];
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal menghapus galeri atau foto terkait.'];
    }
} else {
    $_SESSION['pesan'] = ['danger', 'ID galeri tidak valid.'];
}

header("Location: galeri.php");
exit;
