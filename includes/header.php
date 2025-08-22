<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portal CIPDES</title>

  <!-- Bootstrap & Leaflet (CSS) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

  <style>
    body{background:#f8f9fa;scroll-behavior:smooth}
    .navbar-brand{font-weight:700}
    footer{margin-top:30px;padding:15px;background:#343a40;color:#fff;text-align:center}
    #map{height:250px}
  </style>
</head>
<body>

<!-- NAVBAR: seragam di semua halaman -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">CIPDES</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="menu" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#profil">Profil Desa</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#visi">Visi & Misi</a></li>
        <li class="nav-item"><a class="nav-link" href="kategori.php">Kategori Desa</a></li>
        <li class="nav-item"><a class="nav-link" href="berita.php">Berita</a></li> 
        <li class="nav-item"><a class="nav-link" href="Pesan.php">Pesan</a></li>
      </ul>
    </div>
  </div>
</nav>
