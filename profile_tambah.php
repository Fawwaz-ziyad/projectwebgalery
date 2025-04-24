<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';
include '../layouts/header.php';
include '../layouts/sidebar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);

    $simpan = mysqli_query($koneksi, "INSERT INTO profile (judul, isi) VALUES ('$judul', '$isi')");

    if ($simpan) {
        $_SESSION['pesan'] = ['success', 'Halaman profil berhasil ditambahkan!'];
        header('Location: profile.php');
        exit;
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal menambahkan data: ' . mysqli_error($koneksi)];
        header('Location: tambah_profile.php'); // sesuaikan nama file
        exit;
    }
}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Tambah Halaman Profil</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <?php
    // Tampilkan pesan error jika ada di session (misal dari redirect gagal)
    if (isset($_SESSION['pesan'])) {
        list($type, $message) = $_SESSION['pesan'];
        echo "<div class='alert alert-$type'>$message</div>";
        unset($_SESSION['pesan']);
    }
    ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_content">
                    <form method="POST">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi Halaman</label>
                            <textarea name="isi" class="form-control" rows="10" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="profile.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>