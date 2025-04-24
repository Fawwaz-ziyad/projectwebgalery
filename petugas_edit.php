<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['pesan'] = ['danger', 'ID petugas tidak valid.'];
    header("Location: petugas.php");
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    $_SESSION['pesan'] = ['danger', 'Data petugas tidak ditemukan!'];
    header("Location: petugas.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $passwordQuery = "";

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $passwordQuery = ", password = '$password'";
    }

    $update = mysqli_query($koneksi, "UPDATE petugas SET username = '$username' $passwordQuery WHERE id = '$id'");

    if ($update) {
        $_SESSION['pesan'] = ['success', 'Data petugas berhasil diperbarui!'];
        header("Location: petugas.php");
        exit;
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal mengedit data: ' . mysqli_error($koneksi)];
        header("Location: edit_petugas.php?id=$id");
        exit;
    }
}
include '../layouts/header.php';
include '../layouts/sidebar.php';


?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Petugas</h3>
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
        <div class="col-md-6 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Edit Petugas</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password <small>(Biarkan kosong jika tidak ingin diubah)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="petugas.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>