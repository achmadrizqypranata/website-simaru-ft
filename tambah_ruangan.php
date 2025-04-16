<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ruangan - SIMARU FT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Ruangan</h4>
        </div>
        <div class="card-body">
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Ruangan</label>
                    <input type="text" class="form-control" id="nama" name="nama" required placeholder="Misal: C404">
                </div>
                <div class="mb-3">
                    <label for="kursi" class="form-label">Jumlah Kursi</label>
                    <input type="number" class="form-control" id="kursi" name="kursi" required>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Jenis Ruangan</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis" id="kelas" value="Kelas" required>
                        <label class="form-check-label" for="kelas">Kelas</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis" id="lab" value="Lab" required>
                        <label class="form-check-label" for="lab">Lab</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="gedung" class="form-label">Gedung</label>
                    <select class="form-select" id="gedung" name="gedung" required>
                        <option value="">-- Pilih Gedung --</option>
                        <option value="C">Gedung C</option>
                        <option value="D">Gedung D</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Tambahan catatan..."></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="admin.php?page=ruangan" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
