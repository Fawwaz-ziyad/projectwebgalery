<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$id = $_GET['id'];
$kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori WHERE id = $id"));

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    if (mysqli_query($koneksi, "UPDATE kategori SET judul = '$judul' WHERE id = $id")) {
        $_SESSION['pesan'] = ['success', 'Kategori berhasil diedit!'];
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal mengedit kategori.'];
    }
    header("Location: kategori.php");
    exit;
}


include '../layouts/header.php';
include '../layouts/sidebar.php';
include '../layouts/navbar.php';
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Kategori</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit Kategori</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="judul" class="control-label col-md-3 col-sm-3">Judul</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($kategori['judul']) ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="ln_solid"></div><br><br>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-md-offset-3">
                                    <a href="kategori.php" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- x_content -->
                </div> <!-- x_panel -->
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include '../layouts/footer.php'; ?>