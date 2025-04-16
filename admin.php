<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMARU FT - Admin</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar position-fixed top-0 start-0 bg-dark text-white p-3" style="width: 250px; height: 100vh; z-index: 1030;">
        <h4 class="text-center mb-4">SIMARU FT</h4>
        <ul class="nav flex-column">
            <li><a href="admin.php?page=dashboard" class="nav-link text-white">Dashboard</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="admin.php?page=ruangan" class="nav-link text-white">Data Ruangan</a></li>
            <li><a href="admin.php?page=staff" class="nav-link text-white">Data Staff</a></li>
            <li><a href="admin.php?page=dosen" class="nav-link text-white">Data Dosen</a></li>
            <li><a href="admin.php?page=mahasiswa" class="nav-link text-white">Data Mahasiswa</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="admin.php?page=jadwal" class="nav-link text-white">Jadwal Mata Kuliah & Ruangan</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="admin.php?page=pengajuan" class="nav-link text-white">List Pengajuan Peminjaman Ruangan</a></li>
            <li><a href="admin.php?page=laporan" class="nav-link text-white">List Laporan dari Mahasiswa</a></li>
            <hr class="mb-4" style="border-top: 2px solid #ccc;">
            <li><a href="logout.php" class="nav-link text-danger">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <?php
    $judul = 'Dashboard';
    if ($page === 'ruangan') {
        $judul = 'Data Ruangan';
    } elseif ($page === 'staff') {
        $judul = 'Data Staff';
    } elseif ($page === 'dosen') {
        $judul = 'Data Dosen';
    } elseif ($page === 'mahasiswa') {
        $judul = 'Data Mahasiswa';
    } elseif ($page === 'jadwal') {
        $judul = 'Jadwal Mata Kuliah & Ruangan';
    } elseif ($page === 'pengajuan') {
        $judul = 'List Pengajuan Peminjaman Ruangan';
    } elseif ($page === 'laporan') {
        $judul = 'List Laporan dari Mahasiswa';
    }
    ?>
    <div class="flex-grow-1 p-4" style="margin-left: 250px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= $judul ?></h2>
            <div class="user-info">
                <img src="assets/img/user.png" class="me-2" width="32">
                <h6 class="m-0">Halo, <?= ucfirst($_SESSION['username']); ?></h6>
            </div>
        </div>


        <hr class="mb-4" style="border-top: 2px solid #ccc;">

        <?php if ($page === 'dashboard'): ?>
            <!-- Dashboard content -->
            <div class="row text-white mb-4">
                <div class="col-md-3"><div class="info-box bg-primary"><h3>20</h3><p>Total Ruangan</p></div></div>
                <div class="col-md-3"><div class="info-box bg-success"><h3>5</h3><p>Total Staff</p></div></div>
                <div class="col-md-3"><div class="info-box bg-warning text-dark"><h3>15</h3><p>Total Dosen</p></div></div>
                <div class="col-md-3"><div class="info-box bg-danger"><h3>120</h3><p>Total Mahasiswa</p></div></div>
            </div>

            <hr class="mb-4" style="border-top: 2px solid #ccc;">

            <div class="row text-white mb-4">
                <div class="col-md-4"><div class="info-box bg-secondary"><img src="assets/img/pending.png" width="30" class="me-2"> <h5 class="d-inline">Pending: 4</h5></div></div>
                <div class="col-md-4"><div class="info-box bg-success"><img src="assets/img/approved.png" width="30" class="me-2"> <h5 class="d-inline">Disetujui: 10</h5></div></div>
                <div class="col-md-4"><div class="info-box bg-danger"><img src="assets/img/rejected.png" width="30" class="me-2"> <h5 class="d-inline">Ditolak: 2</h5></div></div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">Traffic Peminjaman Ruangan (2025)</div>
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

            <hr class="my-4" style="border-top: 2px solid #ccc;">

        <?php elseif ($page === 'ruangan'): ?>
            <!-- Data Ruangan -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Tambah Ruangan Baru</h5>
            </div>

            <!-- Form Tambah Ruangan -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Form Tambah Ruangan</div>
                <div class="card-body">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Misal: C404" required>
                        </div>
                        <div class="mb-3">
                            <label for="kursi" class="form-label">Jumlah Kursi</label>
                            <input type="number" class="form-control" id="kursi" name="kursi" placeholder="Contoh: 30" required>
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
                            <select class="form-select" id="gedung" name="gedung">
                                <option value="">-- Pilih Gedung --</option>
                                <option value="C">Gedung C</option>
                                <option value="D">Gedung D</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Ruangan</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Daftar Ruangan -->
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Jumlah Kursi</th>
                        <th>Jenis Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dataRuangan = [
                        ['nama' => 'C303', 'kursi' => 40, 'jenis' => 'Kelas'],
                        ['nama' => 'C402', 'kursi' => 35, 'jenis' => 'Kelas'],
                        ['nama' => 'C404', 'kursi' => 30, 'jenis' => 'Kelas'],
                        ['nama' => 'C407', 'kursi' => 45, 'jenis' => 'Kelas'],
                        ['nama' => 'D203', 'kursi' => 25, 'jenis' => 'Lab'],
                        ['nama' => 'D208', 'kursi' => 28, 'jenis' => 'Lab'],
                        ['nama' => 'D303', 'kursi' => 26, 'jenis' => 'Lab'],
                        ['nama' => 'D308', 'kursi' => 29, 'jenis' => 'Lab'],
                        ['nama' => 'D309', 'kursi' => 45, 'jenis' => 'Kelas'],
                        ['nama' => 'D402', 'kursi' => 40, 'jenis' => 'Kelas'],
                        ['nama' => 'D408', 'kursi' => 85, 'jenis' => 'Kelas'],
                    ];
                    $no = 1;
                    foreach ($dataRuangan as $r): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['nama'] ?></td>
                            <td><?= $r['kursi'] ?></td>
                            <td><?= $r['jenis'] ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($page === 'staff'): ?>
            <!-- Data Staff -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Tambah Staff Baru</h5>
            </div>
            
            <!-- Form Tambah Staff -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Form Tambah Staff</div>
                <div class="card-body">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Staff</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Siti Aminah" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Contoh: 198512044" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Bagian Staff</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bagian" id="akademik" value="Akademik" required>
                                <label class="form-check-label" for="akademik">Akademik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bagian" id="keuangan" value="Keuangan">
                                <label class="form-check-label" for="keuangan">Keuangan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bagian" id="laboratorium" value="Laboratorium">
                                <label class="form-check-label" for="laboratorium">Laboratorium</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Nomor Kontak</label>
                            <input type="tel" class="form-control" id="kontak" name="kontak" placeholder="Contoh: 081234567890" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Staff</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Contoh: siti@unmul.ac.id" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Staff</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Data Staff -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Daftar Staff</h5>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Bagian</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dataStaff = [
                        ['nama' => 'Budi Santoso', 'nip' => '198201231', 'bagian' => 'Akademik', 'kontak' => '081234567890', 'email' => 'budi@unmul.ac.id'],
                        ['nama' => 'Siti Aminah', 'nip' => '198512044', 'bagian' => 'Keuangan', 'kontak' => '082112345678', 'email' => 'siti@unmul.ac.id'],
                        ['nama' => 'Ahmad Rizal', 'nip' => '197910230', 'bagian' => 'Laboratorium', 'kontak' => '081377788899', 'email' => 'rizal@unmul.ac.id'],
                    ];
                    $no = 1;
                    foreach ($dataStaff as $staff): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $staff['nama'] ?></td>
                            <td><?= $staff['nip'] ?></td>
                            <td><?= $staff['bagian'] ?></td>
                            <td><?= $staff['kontak'] ?></td>
                            <td><?= $staff['email'] ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <?php elseif ($page === 'dosen'): ?>
            <!-- Data Dosen -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Tambah Dosen Baru</h5>
            </div>

            <!-- Form Tambah Dosen -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Form Tambah Dosen</div>
                <div class="card-body">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Prof. Lina Marlina" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Contoh: 196912033" required>
                        </div>
                        <div class="mb-3">
                            <label for="matkul" class="form-label">Mata Kuliah</label>
                            <input type="text" class="form-control" id="matkul" name="matkul" placeholder="Contoh: Perancangan Web" required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="tel" class="form-control" id="kontak" name="kontak" placeholder="Contoh: 081234567890" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Dosen</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Contoh: dosen@unmul.ac.id" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Dosen</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Data Dosen -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Daftar Dosen</h5>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Mata Kuliah</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dataDosen = [
                        ['nama' => 'Dr. Andi Saputra', 'nip' => '197301241', 'matkul' => 'Technopreneurship', 'kontak' => '081234001122', 'email' => 'andi@unmul.ac.id'],
                        ['nama' => 'Prof. Lina Marlina', 'nip' => '196912033', 'matkul' => 'Perancangan Web', 'kontak' => '082198763451', 'email' => 'lina@unmul.ac.id'],
                        ['nama' => 'Ir. Bambang Hadi', 'nip' => '198004058', 'matkul' => 'Manajemen Risiko TI', 'kontak' => '081255547788', 'email' => 'bambang@unmul.ac.id'],
                    ];
                    $no = 1;
                    foreach ($dataDosen as $dosen): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $dosen['nama'] ?></td>
                            <td><?= $dosen['nip'] ?></td>
                            <td><?= $dosen['matkul'] ?></td>
                            <td><?= $dosen['kontak'] ?></td>
                            <td><?= $dosen['email'] ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($page === 'mahasiswa'): ?>
            <!-- Data Mahasiswa -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Tambah Mahasiswa Baru</h5>
            </div>

            <!-- Form Tambah Mahasiswa -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Form Tambah Mahasiswa</div>
                <div class="card-body">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Aulia Rahma" required>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="Contoh: 210910123" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="laki" value="Laki-laki" required>
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi" required>
                                <option value="">-- Pilih Prodi --</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Teknik Pertambangan">Teknik Pertambangan</option>
                                <option value="Teknik Sipil">Teknik Sipil</option>
                                <option value="Teknik Industri">Teknik Industri</option>
                                <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                                <option value="Teknik Elektro">Teknik Elektro</option>
                                <option value="Teknik Geologi">Teknik Geologi</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Kimia">Teknik Kimia</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Mahasiswa</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Data Mahasiswa -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Daftar Mahasiswa</h5>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Jenis Kelamin</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dataMahasiswa = [
                        ['nama' => 'Aulia Rahma', 'nim' => '210910123', 'gender' => 'Perempuan', 'prodi' => 'Sistem Informasi'],
                        ['nama' => 'Ilham Setiawan', 'nim' => '210910124', 'gender' => 'Laki-laki', 'prodi' => 'Teknik Informatika'],
                        ['nama' => 'Rina Kartika', 'nim' => '210910125', 'gender' => 'Perempuan', 'prodi' => 'Teknik Komputer'],
                    ];
                    $no = 1;
                    foreach ($dataMahasiswa as $mhs): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mhs['nama'] ?></td>
                            <td><?= $mhs['nim'] ?></td>
                            <td><?= $mhs['gender'] ?></td>
                            <td><?= $mhs['prodi'] ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($page === 'jadwal'): ?>
            <!-- Jadwal Mata Kuliah & Ruangan -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Tambah Jadwal Mata Kuliah</h5>
            </div>

            <!-- Form Tambah Jadwal -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Form Tambah Jadwal</div>
                <div class="card-body">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" id="hari" name="hari" required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jum'at">Jum'at</option>
                            </select>
                        </div>

                        <div class="mb-3 row">
                            <div class="col">
                                <label class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jamMulai" name="jam_mulai" min="08:00" max="16:00" required>
                                <div class="invalid-feedback" id="jamMulaiError">Jam mulai harus antara 08:00 dan 16:00.</div>
                            </div>
                            <div class="col">
                                <label class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jamSelesai" name="jam_selesai" min="08:00" max="16:00" required>
                                <div class="invalid-feedback" id="jamSelesaiError">Jam selesai harus antara 08:00 dan 16:00.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="matkul" class="form-label">Mata Kuliah</label>
                            <input type="text" class="form-control" id="matkul" name="matkul" placeholder="Contoh: Manajemen Risiko TI" required>
                        </div>

                        <div class="mb-3">
                            <label for="ruangan" class="form-label">Ruangan</label>
                            <select class="form-select" id="ruangan" name="ruangan" required>
                                <option value="">-- Pilih Ruangan --</option>
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

                        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
                    </form>
                </div>
            </div>

            <!-- JavaScript Validasi Jam -->
            <script>
                function validasiJam(inputId, errorId) {
                    const input = document.getElementById(inputId);
                    const error = document.getElementById(errorId);
                    input.addEventListener('input', function () {
                        const jam = this.value;
                        if (jam < "08:00" || jam > "16:00") {
                            this.classList.add('is-invalid');
                            error.style.display = 'block';
                        } else {
                            this.classList.remove('is-invalid');
                            error.style.display = 'none';
                        }
                    });
                }

                validasiJam('jamMulai', 'jamMulaiError');
                validasiJam('jamSelesai', 'jamSelesaiError');
            </script>

            <!-- Tabel Jadwal -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Daftar Jadwal</h5>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
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
                        ['hari' => "Jum'at", 'jam' => '15:00 - 16:30', 'matkul' => 'Praktikum PDAB', 'ruangan' => 'D303'],
                    ];

                    foreach ($jadwal as $j): ?>
                        <tr>
                            <td><?= $j['hari'] ?></td>
                            <td><?= $j['jam'] ?></td>
                            <td><?= $j['matkul'] ?></td>
                            <td><?= $j['ruangan'] ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($page === 'pengajuan'): ?>
            <!-- List Pengajuan Peminjaman Ruangan -->
            <div class="d-flex justify-content-between align-items-center mb-4"></div>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
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
                        ['nama' => 'Aulia Rahma', 'nim' => '210910123', 'prodi' => 'Sistem Informasi', 'jadwal' => 'Senin 16:00 - 18:00', 'matkul' => 'Praktikum WEB', 'dosen' => 'Dr. Andi'],
                        ['nama' => 'Ilham Setiawan', 'nim' => '210910124', 'prodi' => 'Informatika', 'jadwal' => 'Selasa 07:30 - 09:00', 'matkul' => 'Pemrograman Web', 'dosen' => 'Prof. Lina'],
                        ['nama' => 'Rina Kartika', 'nim' => '210910125', 'prodi' => 'Teknik Komputer', 'jadwal' => 'Rabu 10:50 - 12:20', 'matkul' => 'Analitika Bisnis', 'dosen' => 'Ir. Bambang'],
                        ['nama' => 'Fadli Putra', 'nim' => '210910126', 'prodi' => 'Sistem Informasi', 'jadwal' => 'Kamis 10:50 - 12:20', 'matkul' => 'ERP', 'dosen' => 'Dr. Andi'],
                        ['nama' => 'Salsa Meidya', 'nim' => '210910127', 'prodi' => 'Informatika', 'jadwal' => 'Jumat 15:00 - 16:30', 'matkul' => 'Praktikum PDAB', 'dosen' => 'Prof. Lina'],
                        ['nama' => 'Rizky Ramadhan', 'nim' => '210910128', 'prodi' => 'Teknik Komputer', 'jadwal' => 'Senin 09:10 - 10:40', 'matkul' => 'Jaringan Komputer', 'dosen' => 'Ir. Bambang'],
                        ['nama' => 'Dina Zahra', 'nim' => '210910129', 'prodi' => 'Sistem Informasi', 'jadwal' => 'Selasa 13:00 - 14:30', 'matkul' => 'Manajemen Proyek', 'dosen' => 'Dr. Andi'],
                        ['nama' => 'Bima Putra', 'nim' => '210910130', 'prodi' => 'Informatika', 'jadwal' => 'Rabu 07:30 - 09:00', 'matkul' => 'Manajemen Risiko TI', 'dosen' => 'Prof. Lina'],
                        ['nama' => 'Zahra Lestari', 'nim' => '210910131', 'prodi' => 'Teknik Komputer', 'jadwal' => 'Kamis 08:00 - 09:30', 'matkul' => 'Keamanan Informasi', 'dosen' => 'Ir. Bambang'],
                        ['nama' => 'Andi Saputra', 'nim' => '210910132', 'prodi' => 'Sistem Informasi', 'jadwal' => 'Jumat 10:00 - 11:30', 'matkul' => 'Etika Profesi', 'dosen' => 'Dr. Andi'],
                    ];

                    $no = 1;
                    foreach ($pengajuan as $pj): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pj['nama'] ?></td>
                            <td><?= $pj['nim'] ?></td>
                            <td><?= $pj['prodi'] ?></td>
                            <td><?= $pj['jadwal'] ?></td>
                            <td><?= $pj['matkul'] ?></td>
                            <td><?= $pj['dosen'] ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($page === 'laporan'): ?>
            <!-- List Laporan dari Mahasiswa -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>Daftar Laporan Mahasiswa</h5>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Lokasi</th>
                        <th>Laporan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $laporanMahasiswa = [
                        ['nama' => 'Aulia Rahma', 'nim' => '210910123', 'prodi' => 'Sistem Informasi', 'lokasi' => 'C404', 'laporan' => 'Kursi rusak', 'status' => 'Pending'],
                        ['nama' => 'Ilham Setiawan', 'nim' => '210910124', 'prodi' => 'Informatika', 'lokasi' => 'D402', 'laporan' => 'Spidol habis', 'status' => 'Pending'],
                        ['nama' => 'Rina Kartika', 'nim' => '210910125', 'prodi' => 'Teknik Komputer', 'lokasi' => 'D203', 'laporan' => 'AC mati', 'status' => 'Pending'],
                        ['nama' => 'Fadli Putra', 'nim' => '210910126', 'prodi' => 'Sistem Informasi', 'lokasi' => 'C303', 'laporan' => 'Proyektor tidak menyala', 'status' => 'Pending'],
                        ['nama' => 'Salsa Meidya', 'nim' => '210910127', 'prodi' => 'Informatika', 'lokasi' => 'D408', 'laporan' => 'Lampu berkedip', 'status' => 'Selesai'],
                        ['nama' => 'Rizky Ramadhan', 'nim' => '210910128', 'prodi' => 'Teknik Komputer', 'lokasi' => 'D208', 'laporan' => 'AC tidak berfungsi', 'status' => 'Selesai'],
                        ['nama' => 'Dina Zahra', 'nim' => '210910129', 'prodi' => 'Sistem Informasi', 'lokasi' => 'D308', 'laporan' => 'Papan tulis rusak', 'status' => 'Pending'],
                        ['nama' => 'Bima Putra', 'nim' => '210910130', 'prodi' => 'Informatika', 'lokasi' => 'D309', 'laporan' => 'Colokan listrik rusak', 'status' => 'Selesai'],
                        ['nama' => 'Zahra Lestari', 'nim' => '210910131', 'prodi' => 'Teknik Komputer', 'lokasi' => 'C402', 'laporan' => 'Meja goyang', 'status' => 'Selesai'],
                        ['nama' => 'Andi Saputra', 'nim' => '210910132', 'prodi' => 'Sistem Informasi', 'lokasi' => 'C407', 'laporan' => 'Spidol tidak bisa dipakai', 'status' => 'Pending'],
                    ];

                    $no = 1;
                    foreach ($laporanMahasiswa as $lap): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $lap['nama'] ?></td>
                            <td><?= $lap['nim'] ?></td>
                            <td><?= $lap['prodi'] ?></td>
                            <td><?= $lap['lokasi'] ?></td>
                            <td><?= $lap['laporan'] ?></td>
                            <td>
                                <?php if ($lap['status'] === 'Selesai'): ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </td>
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
