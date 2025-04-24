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

$query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id ASC");
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h3>Manajemen Kategori</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Kategori</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="kategori_tambah.php" class="btn btn-sm btn-primary">+ Tambah Kategori</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive">
                            <?php if (isset($_SESSION['pesan'])) : ?>
                                <?php list($jenis, $isi) = $_SESSION['pesan']; ?>
                                <div class="alert alert-<?= $jenis ?> alert-dismissible fade show" role="alert">
                                    <?= $isi ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php unset($_SESSION['pesan']); ?>
                            <?php endif; ?>
                            <table class="table table-bordered table-striped jambo_table bulk_action">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 60px;">No</th>
                                        <th>Judul</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) :
                                    ?>
                                        <tr style="text-align: center;">
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($row['judul']) ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="kategori_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="kategori_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus kategori ini?')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>