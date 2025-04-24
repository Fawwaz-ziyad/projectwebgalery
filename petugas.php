<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';
include '../layouts/header.php';
include '../layouts/sidebar.php';

$query = mysqli_query($koneksi, "SELECT * FROM petugas ORDER BY id DESC");
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Manajemen Petugas</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <a href="petugas_tambah.php" class="btn btn-primary mb-3">+ Tambah Petugas</a>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Petugas</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <?php if (isset($_SESSION['pesan'])) : ?>
                        <?php list($jenis, $isi) = $_SESSION['pesan']; ?>
                        <div class="alert alert-<?= $jenis ?> alert-dismissible fade show" role="alert">
                            <?= $isi ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['pesan']); ?>
                    <?php endif; ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Username</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr style="text-align: center;">
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($data['username']) ?></td>
                                    <td><?= $data['created_at'] ?></td>
                                    <td>
                                        <a href="petugas_edit.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="petugas_hapus.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>