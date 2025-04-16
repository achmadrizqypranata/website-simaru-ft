<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMARU FT Unmul</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="unmul.png" alt="Logo Unmul" width="40" height="40" class="me-2">
                Simaru FT
            </a>
            <div class="ms-auto">
                <a href="login.php">
                    <img src="login.png" alt="Login" class="login-icon">
                </a>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <section id="welcome" class="position-relative text-center text-white d-flex align-items-center justify-content-center">
        <div class="slideshow position-absolute w-100 h-100" id="slideshow"></div>
        <div class="overlay position-absolute w-100 h-100 bg-dark bg-opacity-50"></div>
        <div class="welcome-text position-relative z-1">
            <h1 class="display-4 fw-bold">Selamat Datang di Simaru FT</h1>
            <p class="lead">Sistem Manajemen Ruangan Fakultas Teknik Unmul</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3 mt-auto">
        &copy; 2025 Achmad Rizqy Pranata
    </footer>

    <!-- JavaScript for Slideshow -->
    <script>
        const slideshow = document.getElementById("slideshow");
        const images = ["bg1.jpg", "bg2.jpg", "bg3.jpg"];
        let index = 0;

        function changeBackground() {
            slideshow.style.backgroundImage = `url('${images[index]}')`;
            index = (index + 1) % images.length;
        }

        changeBackground(); // set awal
        setInterval(changeBackground, 4500); // ganti tiap 4.5 detik
    </script>

    <!-- Bootstrap Bundle JS (opsional, untuk fitur seperti dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
