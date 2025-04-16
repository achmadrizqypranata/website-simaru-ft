<?php
session_start();

// Daftar user sebagai array
$users = [
    ['username' => 'admin', 'password' => 'admin123', 'role' => 'Admin'],
    ['username' => 'staff', 'password' => 'staff123', 'role' => 'Staff'],
    ['username' => 'mahasiswa', 'password' => 'mahasiswa123', 'role' => 'Mahasiswa']
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $found = false;
    foreach ($users as $user) {
        if ($user['username'] === $inputUsername && $user['password'] === $inputPassword) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect sesuai role
            if ($user['role'] === 'Admin') {
                header("Location: admin.php");
            } elseif ($user['role'] === 'Staff') {
                header("Location: staff.php");
            } elseif ($user['role'] === 'Mahasiswa') {
                header("Location: mahasiswa.php");
            }
            exit;
        }
    }

    $error = "Username atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SIMARU FT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- jika perlu tambahan style -->
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Login SIMARU FT</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        <form method="post" action="aksi_login.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3 text-muted">&copy; 2025 Achmad Rizqy Pranata</p>
            </div>
        </div>
    </div>
</body>
</html>
