<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['pesan'] = ['danger', 'ID post tidak valid.'];
    header("Location: post.php");
    exit;
}

$postQuery = mysqli_query($koneksi, "SELECT * FROM posts WHERE id = $id");
$post = mysqli_fetch_assoc($postQuery);
if (!$post) {
    $_SESSION['pesan'] = ['danger', 'Data post tidak ditemukan!'];
    header("Location: post.php");
    exit;
}

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $kategori_id = $_POST['kategori_id'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE posts SET 
        judul = '$judul', 
        isi = '$isi', 
        kategori_id = '$kategori_id', 
        status = '$status' 
        WHERE id = $id";

    if (mysqli_query($koneksi, $updateQuery)) {
        $_SESSION['pesan'] = ['success', 'Post berhasil diperbarui!'];
        header("Location: post.php?id");
        exit;
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal memperbarui post: ' . mysqli_error($koneksi)];
        header("Location: edit_post.php?id=$id");
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
            <h3>Edit Post</h3>
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
        <div class="col-md-8 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    <form method="post">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($post['judul']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <?php while ($k = mysqli_fetch_assoc($kategori)) {
                                    $selected = ($k['id'] == $post['kategori_id']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($k['id']) . "' $selected>" . htmlspecialchars($k['judul']) . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea name="isi" class="form-control" rows="5"><?= htmlspecialchars($post['isi']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="draft" <?= ($post['status'] == 'draft') ? 'selected' : '' ?>>Draft</option>
                                <option value="publish" <?= ($post['status'] == 'publish') ? 'selected' : '' ?>>Publish</option>
                            </select>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                        <a href="post.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>