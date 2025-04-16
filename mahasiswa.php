<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: login.php");
    exit;
}
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// SET JUDUL BERDASARKAN HALAMAN
$judul = 'Dashboard';
if ($page === 'pengajuan') {
    $judul = 'Form Pengajuan Peminjaman';
} elseif ($page === 'lapor') {
    $judul = 'Form Lapor';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMARU FT - Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar position-fixed top-0 start-0 text-white" style="width: 250px; height: 100vh; background-color: #006400; z-index: 1030;">
        <h4 class="text-center mb-4">SIMARU FT</h4>
        <ul class="nav flex-column">
            <li><a href="mahasiswa.php?page=dashboard" class="nav-link text-white">Dashboard</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="mahasiswa.php?page=pengajuan" class="nav-link text-white">Pengajuan Peminjaman</a></li>
            <li><a href="mahasiswa.php?page=lapor" class="nav-link text-white">Lapor</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="logout.php" class="nav-link text-danger">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4" style="margin-left: 250px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= $judul ?></h2>
            <div class="user-info">
                <img src="assets/img/user3.jpg" class="me-2" width="32">
                <h6 class="m-0">Halo, <?= ucfirst($_SESSION['username']); ?></h6>
            </div>
        </div>

        <?php if ($page === 'dashboard'): ?>
            <!-- Kalender Jadwal -->
            <div class="card">
                <div class="card-header bg-success text-white">Kalender Jadwal Kuliah</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-success">
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Mata Kuliah</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jadwal = [
                                ['hari' => 'Senin', 'jam' => '07:30 - 09:00', 'matkul' => 'Technopreneurship', 'ruangan' => 'C404'],
                                ['hari' => 'Senin', 'jam' => '16:00 - 18:00', 'matkul' => 'Praktikum WEB', 'ruangan' => 'D308'],
                                ['hari' => 'Selasa', 'jam' => '07:30 - 09:00', 'matkul' => 'Perancangan dan Pemrograman Web', 'ruangan' => 'C303'],
                                ['hari' => 'Selasa', 'jam' => '09:10 - 10:40', 'matkul' => 'Adopsi Teknologi Informasi', 'ruangan' => 'D408'],
                                ['hari' => 'Rabu', 'jam' => '07:30 - 09:00', 'matkul' => 'Manajemen Resiko TI', 'ruangan' => 'D402'],
                                ['hari' => 'Rabu', 'jam' => '10:50 - 12:20', 'matkul' => 'Penggalian Data dan Analitika Proses Bisnis', 'ruangan' => 'D402'],
                                ['hari' => 'Kamis', 'jam' => '10:50 - 12:20', 'matkul' => 'Perencanaan Sumberdaya Perusahaan', 'ruangan' => 'C403'],
                                ['hari' => 'Jum\'at', 'jam' => '15:00 - 16:30', 'matkul' => 'Praktikum PDAB', 'ruangan' => 'D303'],
                            ];
                            foreach ($jadwal as $j): ?>
                                <tr>
                                    <td><?= $j['hari'] ?></td>
                                    <td><?= $j['jam'] ?></td>
                                    <td><?= $j['matkul'] ?></td>
                                    <td><?= $j['ruangan'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php elseif ($page === 'pengajuan'): ?>
            <!-- Form Pengajuan -->
            <form method="post" action="#">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim">
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select class="form-select" id="prodi" name="prodi">
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Pertambangan">Teknik Pertambangan</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Geologi">Teknik Geologi</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <input type="text" class="form-control" placeholder="Contoh: Adopsi Teknologi Informasi">
                </div>
                <div class="mb-3">
                    <label for="ruangan" class="form-label">Ruangan yang Diajukan</label>
                    <select class="form-select" id="ruangan" name="ruangan">
                        <option value="C303">C303</option>
                        <option value="D308">D308</option>
                        <option value="C303">C303</option>
                        <option value="C402">C402</option>
                        <option value="C404">C404</option>
                        <option value="C407">C407</option>
                        <option value="D203">D203</option>
                        <option value="D208">D208</option>
                        <option value="D303">D303</option>
                        <option value="D308">D308</option>
                        <option value="D309">D309</option>
                        <option value="D402">D402</option>
                        <option value="D408">D408</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jam</label>
                    <input type="time" class="form-control" id="jam" name="jam" min="08:00" max="16:00" required>
                    <div class="invalid-feedback" id="jamError">Jam harus antara 08:00 dan 16:00.</div>
                </div>

                <script>
                    const jamInput = document.getElementById('jam');
                    const jamError = document.getElementById('jamError');

                    jamInput.addEventListener('input', function () {
                        const jam = this.value;
                        if (jam < "08:00" || jam > "16:00") {
                            this.classList.add('is-invalid');
                            jamError.style.display = 'block';
                        } else {
                            this.classList.remove('is-invalid');
                            jamError.style.display = 'none';
                        }
                    });
                </script>


                <button class="btn btn-success">Ajukan</button>
            </form>

        <?php elseif ($page === 'lapor'): ?>
            <form method="post" action="#">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim">
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select class="form-select" id="prodi" name="prodi">
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Pertambangan">Teknik Pertambangan</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Geologi">Teknik Geologi</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                    </select>
                </div>
                <div class="mb-3">
                <label for="ruangan" class="form-label">Lokasi</label>
                    <select class="form-select" id="ruangan" name="ruangan" onchange="toggleInputLainnya()">
                        <option value="C303">C303</option>
                        <option value="C402">C402</option>
                        <option value="C404">C404</option>
                        <option value="C407">C407</option>
                        <option value="D203">D203</option>
                        <option value="D208">D208</option>
                        <option value="D303">D303</option>
                        <option value="D308">D308</option>
                        <option value="D309">D309</option>
                        <option value="D402">D402</option>
                        <option value="D408">D408</option>
                        <option value="lain">Lain-Lain</option>
                    </select>
                </div>

                <!-- Input yang muncul jika pilih Lain-Lain -->
                <div class="mb-3" id="inputLainnya" style="display: none;">
                    <label for="ruangan_lain" class="form-label">Tuliskan Lokasi Detail</label>
                    <input type="text" class="form-control" id="ruangan_lain" name="ruangan_lain" placeholder="Contoh: Lorong Gedung C Lantai 4">
                </div>
                <script>
                    function toggleInputLainnya() {
                        var select = document.getElementById("ruangan");
                        var inputLainnya = document.getElementById("inputLainnya");

                        if (select.value === "lain") {
                            inputLainnya.style.display = "block";
                        } else {
                            inputLainnya.style.display = "none";
                        }
                    }
                </script>
                <div class="mb-3">
                    <label class="form-label">Keluhan</label>
                    <textarea class="form-control" rows="3" placeholder="Contoh: Kursi rusak, spidol habis, dll."></textarea>
                </div>
                <button class="btn btn-warning">Kirim Laporan</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
