<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';
include '../layouts/header.php';
include '../layouts/sidebar.php';
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Manajemen Halaman Profil</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <a href="profile_tambah.php" class="btn btn-primary btn-sm">+ Tambah Halaman</a>
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
                                <th>Judul</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM profile ORDER BY created_at DESC");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<tr style='text-align: center;'>

                                    <td>{$row['judul']}</td>
                                    <td>{$row['created_at']}</td>
                                    <td>
                                        <a href='profile_edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='profile_hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>