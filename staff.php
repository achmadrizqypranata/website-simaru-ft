<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: login.php");
    exit;
}
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// SET JUDUL BERDASARKAN HALAMAN
$judul = 'Dashboard';
if ($page === 'persetujuan') {
    $judul = 'Persetujuan Peminjaman';
} elseif ($page === 'laporan') {
    $judul = 'Laporan Mahasiswa';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMARU FT - Staff</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar position-fixed top-0 start-0 bg-secondary text-white" style="width: 250px; height: 100vh; z-index: 1030;">
        <h4 class="text-center mb-4">SIMARU FT</h4>
        <ul class="nav flex-column">
            <li><a href="staff.php?page=dashboard" class="nav-link text-white">Dashboard</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="staff.php?page=persetujuan" class="nav-link text-white">Persetujuan Peminjaman</a></li>
            <li><a href="staff.php?page=laporan" class="nav-link text-white">Laporan Mahasiswa</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="logout.php" class="nav-link text-danger">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4" style="margin-left: 250px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= $judul ?></h2>
            <div class="user-info">
                <img src="assets/img/user2.jpg" class="me-2" width="32">
                <h6 class="m-0">Halo, <?= ucfirst($_SESSION['username']); ?></h6>
            </div>
        </div>

        <?php if ($page === 'dashboard'): ?>
            <div class="row text-white mb-4">
                <div class="col-md-4"><div class="info-box bg-secondary"><img src="assets/img/pending.png" width="30" class="me-2"> <h5 class="d-inline">Pending: 4</h5></div></div>
                <div class="col-md-4"><div class="info-box bg-success"><img src="assets/img/approved.png" width="30" class="me-2"> <h5 class="d-inline">Disetujui: 10</h5></div></div>
                <div class="col-md-4"><div class="info-box bg-danger"><img src="assets/img/rejected.png" width="30" class="me-2"> <h5 class="d-inline">Ditolak: 2</h5></div></div>
            </div>

            <hr class="mb-4" style="border-top: 2px solid #ccc;">

            <div class="card mt-4">
                <div class="card-header bg-info text-white">Traffic Peminjaman Ruangan (2025)</div>
                <div class="card-body">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-warning text-dark">Traffic Laporan dari Mahasiswa (2025)</div>
                <div class="card-body">
                    <canvas id="laporanChart"></canvas>
                </div>
            </div>

        <?php elseif ($page === 'persetujuan'): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Jadwal Ganti</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pengajuan = [
                        ['nama' => 'Aulia Rahma', 'nim' => '210910123', 'prodi' => 'SI', 'jadwal' => 'Senin 16:00', 'matkul' => 'Praktikum WEB', 'dosen' => 'Dr. Andi'],
                        ['nama' => 'Ilham Setiawan', 'nim' => '210910124', 'prodi' => 'TI', 'jadwal' => 'Selasa 07:30', 'matkul' => 'Pemrograman Web', 'dosen' => 'Prof. Lina']
                    ];
                    foreach ($pengajuan as $pj): ?>
                        <tr>
                            <td><?= $pj['nama'] ?></td>
                            <td><?= $pj['nim'] ?></td>
                            <td><?= $pj['prodi'] ?></td>
                            <td><?= $pj['jadwal'] ?></td>
                            <td><?= $pj['matkul'] ?></td>
                            <td><?= $pj['dosen'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-success">Setujui</button>
                                <button class="btn btn-sm btn-danger">Tolak</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($page === 'laporan'): ?>
            <!-- Laporan Pending -->
            <h5 class="mb-3">Laporan Pending</h5>
            <table class="table table-bordered table-striped mb-5">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Laporan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $laporanPending = [
                        ['nama' => 'Rina Kartika', 'nim' => '210910125', 'prodi' => 'Teknik Komputer', 'laporan' => 'Kursi rusak di C404'],
                        ['nama' => 'Fadli Putra', 'nim' => '210910126', 'prodi' => 'SI', 'laporan' => 'Spidol habis di D308']
                    ];
                    foreach ($laporanPending as $lp): ?>
                        <tr>
                            <td><?= $lp['nama'] ?></td>
                            <td><?= $lp['nim'] ?></td>
                            <td><?= $lp['prodi'] ?></td>
                            <td><?= $lp['laporan'] ?></td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-success">Tandai Selesai</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Laporan Selesai -->
            <h5 class="mb-3">Laporan Selesai</h5>
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Laporan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $laporanSelesai = [
                        ['nama' => 'Salsa Meidya', 'nim' => '210910127', 'prodi' => 'Informatika', 'laporan' => 'AC tidak berfungsi di D208'],
                        ['nama' => 'Bima Putra', 'nim' => '210910130', 'prodi' => 'Informatika', 'laporan' => 'Meja goyang di C402']
                    ];
                    foreach ($laporanSelesai as $lp): ?>
                        <tr>
                            <td><?= $lp['nama'] ?></td>
                            <td><?= $lp['nim'] ?></td>
                            <td><?= $lp['prodi'] ?></td>
                            <td><?= $lp['laporan'] ?></td>
                            <td><span class="badge bg-success">Selesai</span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<!-- Chart JS -->
<?php if ($page === 'dashboard'): ?>
<script>
    const ctx = document.getElementById('trafficChart').getContext('2d');
    const trafficChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April'],
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: [20, 35, 25, 40],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const ctx2 = document.getElementById('laporanChart').getContext('2d');
    const laporanChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [5, 8, 4, 10],
                backgroundColor: 'rgba(255,193,7,0.8)',
                borderColor: 'rgba(255,193,7,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
<?php endif; ?>

</body>
</html>