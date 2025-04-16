<?php
session_start();

$users = [
    ['username' => 'fadhil', 'password' => 'fadhil727', 'role' => 'admin'],
    ['username' => 'budi', 'password' => 'budi235', 'role' => 'staff'],
    ['username' => 'ilham', 'password' => 'ilham568', 'role' => 'mahasiswa'],
];

$username = $_POST['username'];
$password = $_POST['password'];

$loginSukses = false;

foreach ($users as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $loginSukses = true;
        break;
    }
}

if ($loginSukses) {
    // Redirect sesuai role
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } elseif ($_SESSION['role'] === 'staff') {
        header("Location: staff.php");
    } elseif ($_SESSION['role'] === 'mahasiswa') {
        header("Location: mahasiswa.php");
    }
    exit;
} else {
    echo "<script>alert('Username atau Password salah'); window.location='login.php';</script>";
}
