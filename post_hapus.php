<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['pesan'] = ['danger', 'ID post tidak valid.'];
    header("Location: post.php");
    exit;
}

$hapus = mysqli_query($koneksi, "DELETE FROM posts WHERE id = $id");

if ($hapus) {
    $_SESSION['pesan'] = ['success', 'Post berhasil dihapus!'];
} else {
    $_SESSION['pesan'] = ['danger', 'Gagal menghapus post!'];
}

header("Location: post.php");
exit;
