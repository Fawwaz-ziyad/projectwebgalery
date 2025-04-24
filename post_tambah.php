<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $kategori_id = $_POST['kategori_id'];
    $status = $_POST['status'];
    $petugas_id = $_SESSION['admin_id'];

    $query = mysqli_query($koneksi, "INSERT INTO posts (judul, isi, kategori_id, status, petugas_id, created_at)
                         VALUES ('$judul', '$isi', '$kategori_id', '$status', '$petugas_id', NOW())");

    if ($query) {
        $_SESSION['pesan'] = ['success', 'Post berhasil disimpan!'];
        header("Location: post.php");
        exit;
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal menyimpan post: ' . mysqli_error($koneksi)];
        header("Location: tambah_post.php"); // Asumsikan file ini bernama tambah_post.php
        exit;
    }
}

include '../layouts/header.php';
include '../layouts/sidebar.php';
include '../layouts/navbar.php';
?>

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Tambah Post</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <?php
    // Tampilkan pesan jika ada
    if (isset($_SESSION['pesan'])) {
        list($type, $message) = $_SESSION['pesan'];
        echo "<div class='alert alert-$type'>$message</div>";
        unset($_SESSION['pesan']);
    }
    ?>

    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    <form method="post">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <?php while ($k = mysqli_fetch_assoc($kategori)) {
                                    echo "<option value='{$k['id']}'>" . htmlspecialchars($k['judul']) . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea name="isi" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="publish">Publish</option>
                            </select>
                        </div>
                        <a href="post.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>