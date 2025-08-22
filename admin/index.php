<?php
session_start();  
// Jika belum login, redirect ke login.php
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard Admin</a>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-light p-3 border-end" style="height: 100vh;">
                <h5>Menu</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="../public/index.php" class="nav-link" target="_blank">
                            <i class="fa fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item"><a href="profil.php" class="nav-link"><i class="fa fa-user"></i> Profil</a></li>
                    <li class="nav-item"><a href="berita.php" class="nav-link"><i class="fa fa-newspaper"></i> Berita</a></li>
                    <li class="nav-item"><a href="kategori.php" class="nav-link"><i class="fa fa-list"></i> Kategori</a></li>
                    <li class="nav-item"><a href="visi_misi.php" class="nav-link"><i class="fa fa-bullseye"></i> Visi Misi</a></li>
                    <li class="nav-item"><a href="pesan.php" class="nav-link"><i class="fa fa-envelope"></i> Pesan</a></li>
                </ul>
            </div>

            <!-- Konten utama -->
            <div class="col-md-9 col-lg-10 p-4">
                <h3>Selamat Datang, Admin!</h3>
                <p>Anda dapat mengelola konten website melalui menu di samping.</p>
                
                <div class="row">
                    <!-- Profil -->
                    <div class="col-md-3 mb-3">
                        <div class="card text-white bg-primary h-100">
                            <div class="card-body">
                                <h5 class="card-title">Profil</h5>
                                <p class="card-text">Kelola profil desa.</p>
                                <a href="profil.php" class="btn btn-light btn-sm">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <!-- Berita -->
                    <div class="col-md-3 mb-3">
                        <div class="card text-white bg-success h-100">
                            <div class="card-body">
                                <h5 class="card-title">Berita</h5>
                                <p class="card-text">Kelola berita desa.</p>
                                <a href="berita.php" class="btn btn-light btn-sm">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-3 mb-3">
                        <div class="card text-dark bg-warning h-100">
                            <div class="card-body">
                                <h5 class="card-title">Kategori</h5>
                                <p class="card-text">Kelola kategori konten.</p>
                                <a href="kategori.php" class="btn btn-light btn-sm">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <!-- Visi Misi -->
                    <div class="col-md-3 mb-3">
                        <div class="card text-white bg-danger h-100">
                            <div class="card-body">
                                <h5 class="card-title">Visi Misi</h5>
                                <p class="card-text">Kelola visi & misi desa.</p>
                                <a href="visi_misi.php" class="btn btn-light btn-sm">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div class="col-md-3 mb-3">
                        <div class="card text-white bg-info h-100">
                            <div class="card-body">
                                <h5 class="card-title">Pesan</h5>
                                <p class="card-text">Kelola pesan masuk.</p>
                                <a href="pesan.php" class="btn btn-light btn-sm">Kelola</a>
                            </div>
                        </div>
                    </div>

                    
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
