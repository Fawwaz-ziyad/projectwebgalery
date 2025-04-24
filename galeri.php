<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';
include '../layouts/header.php';
include '../layouts/sidebar.php';
include '../layouts/navbar.php';

$galeri = mysqli_query($koneksi, "
    SELECT galery.*, posts.judul, 
    (SELECT file FROM foto WHERE galery_id = galery.id LIMIT 1) AS foto 
    FROM galery 
    LEFT JOIN posts ON galery.post_id = posts.id 
    ORDER BY galery.id DESC
");

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h3>Manajemen Galeri</h3>
            </div>
            <div class="title_right text-end">
                <a href="galeri_tambah.php" class="btn btn-primary">+ Tambah Galeri</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php if (isset($_SESSION['pesan'])) : ?>
            <?php list($jenis, $isi) = $_SESSION['pesan']; ?>
            <div class="alert alert-<?= $jenis ?> alert-dismissible fade show" role="alert">
                <?= $isi ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['pesan']); ?>
        <?php endif; ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Judul Post</th>
                    <th>Posisi</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = mysqli_fetch_assoc($galeri)) { ?>
                    <tr style="text-align: center;">
                        <td><?= $no++ ?></td>
                        <td><?= $row['judul'] ? htmlspecialchars($row['judul']) : '<span class="text-muted">Tanpa Postingan</span>' ?>
                        </td>
                        <td><?= $row['position'] ?></td>
                        <td>
                            <?php if ($row['foto']) : ?>
                                <img src="../uploads/<?= $row['foto'] ?>" alt="Foto Galeri" width="60" style="border-radius:5px;">
                            <?php else : ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $row['status'] == 1 ? 'Tampil' : 'Sembunyi' ?></td>
                        <td>
                            <a href="galeri_tambah.php?galery_id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Upload Foto</a>
                            <a href="galeri_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="galeri_hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus galeri ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>