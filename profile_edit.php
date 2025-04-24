<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';
include '../layouts/header.php';
include '../layouts/sidebar.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['pesan'] = ['danger', 'ID profile tidak valid.'];
    header("Location: profile.php");
    exit;
}

$q = mysqli_query($koneksi, "SELECT * FROM profile WHERE id = '$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    $_SESSION['pesan'] = ['danger', 'Data profile tidak ditemukan!'];
    header("Location: profile.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);

    $update = mysqli_query($koneksi, "UPDATE profile SET judul = '$judul', isi = '$isi' WHERE id = '$id'");

    if ($update) {
        $_SESSION['pesan'] = ['success', 'Profile berhasil diperbarui!'];
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal mengedit data: ' . mysqli_error($koneksi)];
        header("Location: edit_profile.php?id=$id");
        exit;
    }
}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Halaman Profil</h3>
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
                            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi Halaman</label>
                            <textarea name="isi" class="form-control" rows="10" required><?= htmlspecialchars($data['isi']) ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="profile.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>