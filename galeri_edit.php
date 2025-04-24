<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: galeri.php");
    exit;
}

// Fetch gallery data
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM galery WHERE id = '$id'"));
if (!$data) {
    echo "Galeri tidak ditemukan!";
    exit;
}

// Fetch list of posts
$posts = mysqli_query($koneksi, "SELECT id, judul FROM posts");

if (isset($_POST['update'])) {
    $post_id = $_POST['post_id'] !== '' ? intval($_POST['post_id']) : "NULL";
    $position = intval($_POST['position']);
    $status = $_POST['status'] == '1' ? 1 : 0;

    $query = "UPDATE galery SET post_id = $post_id, position = $position, status = $status WHERE id = $id";
    mysqli_query($koneksi, $query);

    // Cek jika ada file di-upload
    if (!empty($_FILES['foto']['name'])) {
        $namaFile = time() . '_' . basename($_FILES['foto']['name']);
        $lokasiTmp = $_FILES['foto']['tmp_name'];
        $lokasiUpload = '../uploads/' . $namaFile;

        // Upload file
        if (move_uploaded_file($lokasiTmp, $lokasiUpload)) {
            // Hapus foto lama (jika ada)
            $cekFotoLama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM foto WHERE galery_id = $id LIMIT 1"));
            if ($cekFotoLama) {
                @unlink('../uploads/' . $cekFotoLama['foto']);
                mysqli_query($koneksi, "UPDATE foto SET file = '$namaFile' WHERE galery_id = $id");
            } else {
                mysqli_query($koneksi, "INSERT INTO foto (galery_id, file) VALUES ($id, '$namaFile')");
            }
        }
    }

    $_SESSION['pesan'] = ['success', 'Galeri berhasil diperbarui!'];
    header("Location: galeri.php");
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
                <h3>Edit Galeri #<?= htmlspecialchars($id) ?></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit Galeri</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul Postingan</label>
                                <select name="post_id" class="form-control">
                                    <option value="">-- Tanpa Post --</option>
                                    <?php while ($row = mysqli_fetch_assoc($posts)) { ?>
                                        <option value="<?= htmlspecialchars($row['id']) ?>" <?= $data['post_id'] == $row['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($row['judul']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Posisi</label>
                                <input type="number" name="position" class="form-control" required value="<?= htmlspecialchars($data['position']) ?>">
                            </div>

                            <div class="form-group">
                                <label>Ganti Foto Utama (Opsional)</label>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Tampilkan</option>
                                    <option value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Sembunyikan</option>
                                </select>
                            </div>

                            <a href="galeri.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" name="update" class="btn btn-primary">Update Galeri</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>