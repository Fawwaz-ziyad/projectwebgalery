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

$query = mysqli_query($koneksi, "SELECT posts.*, kategori.judul as kategori FROM posts
    LEFT JOIN kategori ON posts.kategori_id = kategori.id
    ORDER BY posts.id ASC");
?>

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Manajemen Post</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <a href="post_tambah.php" class="btn btn-primary mb-3">+ Tambah Post</a>
            <div class="x_panel">
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
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<tr style='text-align: center;'>
                                    <td>$no</td>
                                    <td>{$row['judul']}</td>
                                    <td>{$row['kategori']}</td>
                                    <td>{$row['status']}</td>
                                    <td>{$row['created_at']}</td>
                                    <td>
                                        <a href='post_edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                        <a href='post_hapus.php?id={$row['id']}' onclick=\"return confirm('Hapus data ini?')\" class='btn btn-sm btn-danger'>Hapus</a>
                                    </td>
                                </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>