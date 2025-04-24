<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

$galery_id = $_GET['galery_id'] ?? null;

// Tambah Galeri Baru
if (isset($_POST['simpan'])) {
    $post_id = $_POST['post_id'] !== '' ? "'" . $_POST['post_id'] . "'" : "NULL";
    $position = $_POST['position'];
    $status = $_POST['status'];
    if (mysqli_query($koneksi, "INSERT INTO galery (post_id, position, status) VALUES ($post_id, '$position', '$status')")) {
        $_SESSION['pesan'] = ['success', 'Galeri berhasil ditambahkan!'];
    } else {
        $_SESSION['pesan'] = ['danger', 'Gagal menambahkan galeri.'];
    }
    header("Location: galeri.php");
    exit;
}

//upload foto
if (isset($_POST['upload']) && $galery_id) {
    $judul = $_POST['judul'];
    $files = $_FILES['foto'];

    $uploadSuccess = true; // cek apakah semua file berhasil diupload

    for ($i = 0; $i < count($files['name']); $i++) {
        $namaFile = time() . '_' . basename($files['name'][$i]);
        $lokasi = '../uploads/' . $namaFile;

        if (move_uploaded_file($files['tmp_name'][$i], $lokasi)) {
            // Insert ke database
            $query = "INSERT INTO foto (galery_id, file, judul) VALUES ('$galery_id', '$namaFile', '$judul')";
            if (!mysqli_query($koneksi, $query)) {
                $uploadSuccess = false;
                break; // Stop loop jika query gagal
            }
        } else {
            $uploadSuccess = false;
            break; // Stop loop jika upload file gagal
        }
    }

    if ($uploadSuccess) {
        $_SESSION['pesan'] = ['success', 'Foto berhasil diupload!'];
    } else {
        $_SESSION['pesan'] = ['danger', 'Terjadi kesalahan saat upload foto.'];
    }

    header("Location: galeri.php");
}

$posts = mysqli_query($koneksi, "SELECT id, judul FROM posts");

include '../layouts/header.php';
include '../layouts/sidebar.php';
include '../layouts/navbar.php';

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $galery_id ? "Upload Foto ke Galeri #$galery_id" : "Tambah Galeri Baru" ?></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $galery_id ? "Form Upload Foto" : "Form Tambah Galeri" ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if ($galery_id) { ?>
                            <!-- Upload Foto -->
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Judul Foto</label>
                                    <input type="text" name="judul" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Pilih Foto (bisa lebih dari satu)</label>
                                    <input type="file" name="foto[]" multiple required class="form-control">
                                </div>
                                <button type="submit" name="upload" class="btn btn-success">Upload Foto</button>
                            </form>
                        <?php } else { ?>
                            <!-- Tambah Galeri -->
                            <form method="POST">
                                <div class="form-group">
                                    <label>Judul Postingan</label>
                                    <select name="post_id" class="form-control">
                                        <option value="">-- (Optional) Pilih Post --</option>
                                        <?php while ($row = mysqli_fetch_assoc($posts)) { ?>
                                            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['judul']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Posisi</label>
                                    <input type="number" name="position" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Tampilkan</option>
                                        <option value="0">Sembunyikan</option>
                                    </select>
                                </div>
                                <a href="galeri.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan Galeri</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>