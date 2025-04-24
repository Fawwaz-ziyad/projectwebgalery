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
?>

<?php
// Hitung jumlah data dari masing-masing tabel
$jumlah_kategori = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM kategori"));
$jumlah_post     = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM posts"));
$jumlah_galeri   = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM galery"));
$jumlah_foto     = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM foto"));
$jumlah_profile  = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM profile"));
$jumlah_petugas  = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM petugas"));
?>

<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row" style="display: flex; flex-wrap: wrap;">
        <div class="tile_count">

            <div class="col-md-2 col-sm-6 tile_stats_count">
                <a href="kategori.php"><span class="count_top"><i class="fa fa-tags"></i> Total Kategori</span></a>
                <div class="count"><?= $jumlah_kategori ?></div>
            </div>

            <div class="col-md-2 col-sm-6 tile_stats_count">
                <a href="post.php"><span class="count_top"><i class="fa fa-pencil"></i> Total Post</span></a>
                <div class="count"><?= $jumlah_post ?></div>
            </div>

            <div class="col-md-2 col-sm-6 tile_stats_count">
                <a href="galeri.php"><span class="count_top"><i class="fa fa-table"></i> Total Galeri</span></a>
                <div class="count"><?= $jumlah_galeri ?></div>
            </div>

            <div class="col-md-2 col-sm-6 tile_stats_count">
                <a href="profile.php"><span class="count_top"><i class="fa fa-photo"></i> Total Profile</span></a>
                <div class="count"><?= $jumlah_profile ?></div>
            </div>

            <div class="col-md-2 col-sm-6 tile_stats_count">
                <a href="petugas.php"><span class="count_top"><i class="fa fa-users"></i> Total Petugas</span></a>
                <div class="count"><?= $jumlah_petugas ?></div>
            </div>

        </div>
    </div>

    <!-- /top tiles -->
</div>
<!-- /page content -->

<?php
include '../layouts/footer.php';
?>