<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "INSERT INTO petugas (username, password, created_at) VALUES ('$username', '$password', NOW())");

    if ($query) {
        $_SESSION['pesan'] = ['success', 'Petugas berhasil ditambahkan!'];
        header("Location: petugas.php");
        exit;
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal menambah data!'];
        header("Location: tambah_petugas.php"); // Asumsikan ini nama file tambah petugas
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
            <h3>Tambah Petugas</h3>
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
                    <h2>Form Tambah Petugas</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="petugas.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>