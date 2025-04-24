<?php
session_start();

// Cegah akses login kalau sudah login
if (isset($_SESSION['admin_id'])) {
    header("Location: admin/dashboard.php");
    exit;
}

include 'koneksi.php';

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password_hash = md5($password); // Ganti ke password_hash jika memungkinkan

    // Prepared statement dengan pengecekan
    $stmt = mysqli_prepare($koneksi, "SELECT id, username FROM petugas WHERE username = ? AND password = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password_hash);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $admin = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: admin/dashboard.php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = "Terjadi kesalahan pada server. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Login Admin</title>
    <link href="template/assets/images/raples.jpg" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <div class="text-center mb-3">
                <img src="template/assets/images/raples.jpg" alt="Logo Sekolah" width="80" />
            </div>
            <h4 class="text-center mb-4">Login Admin</h4>

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="post" autocomplete="off" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required autofocus />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password" />
                </div>

                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>