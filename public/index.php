<?php 
session_start();  
include_once '../includes/db.php'; 
include '../includes/header.php'; 
?>

<div class="container mt-4">
  <div class="row">
    
    <!-- Konten Utama -->
    <div class="col-md-8">
      <h2 class="mb-3">Selamat Datang di CIPDES</h2>
      <p>Portal <b>Sistem Informasi Profil Carangrejo</b> yang memuat data profil, dusun, berita, dan layanan publik.</p>

      <!-- Profil Desa -->
      <div id="profil" class="card mb-3">
        <div class="card-header">Profil Desa</div>
        <div class="card-body">
          <?php
          $profil = $conn->query("SELECT * FROM profil_desa ORDER BY id DESC LIMIT 1");
          if($profil && $profil->num_rows > 0){
            $p = $profil->fetch_assoc();
            if(!empty($p['gambar'])){
              echo '<img src="/cipdes/uploads/'.$p['gambar'].'" class="img-fluid rounded mb-2">';
            }
            echo '<h5>'.$p['judul'].'</h5>';
            echo '<p>'.substr($p['isi'],0,200).'...</p>';
          } else {
            echo '<p>Belum ada profil desa.</p>';
          }
          ?>
        </div>
      </div>

      <!-- Visi & Misi -->
      <div id="visi" class="card mb-3">
        <div class="card-header">Visi & Misi</div>
        <div class="card-body">
          <?php
          $visi = $conn->query("SELECT * FROM visi_misi ORDER BY id DESC LIMIT 1");
          if($visi && $visi->num_rows > 0){
            $v = $visi->fetch_assoc();
            echo '<p><strong>Visi:</strong> '.$v['visi'].'</p>';
            echo '<p><strong>Misi:</strong><br>'.nl2br($v['misi']).'</p>';
          } else {
            echo '<p>Belum ada visi misi.</p>';
          }
          ?>
        </div>
      </div>

      <!-- Berita -->
      <div class="card mb-3">
        <div class="card-header">Berita Terbaru</div>
        <div class="card-body">
          <?php
          $berita = $conn->query("SELECT * FROM berita ORDER BY created_at DESC LIMIT 3");
          if($berita && $berita->num_rows > 0){
            while($b = $berita->fetch_assoc()){
              echo '<div class="mb-3">';
              if(!empty($b['gambar'])){
                echo '<img src="/cipdes/uploads/'.$b['gambar'].'" class="img-fluid rounded mb-2">';
              }
              echo '<h5 class="card-title">'.$b['judul'].'</h5>';
              echo '<small class="text-muted">Kategori: '.$b['kategori'].' | '.$b['created_at'].'</small>';
              echo '<p>'.substr($b['isi'],0,120).'...</p>';
              echo '<a href="berita.php?id='.$b['id'].'" class="btn btn-sm btn-danger">Baca selengkapnya</a>';
              echo '</div><hr>';
            }
            echo '<a href="berita.php" class="btn btn-sm btn-secondary">Lihat semua berita</a>';
          } else {
            echo '<p>Belum ada berita.</p>';
          }
          ?>
        </div>
      </div>

      <!-- Pesan -->
      <div class="card mb-3">
        <div class="card-header">Pesan / Pengumuman</div>
        <div class="card-body">
          <?php
          $pesan = $conn->query("SELECT * FROM pesan ORDER BY created_at DESC LIMIT 3");
          if($pesan && $pesan->num_rows > 0){
            while($ps = $pesan->fetch_assoc()){
              echo '<div class="alert alert-info">';
              echo '<strong>Dari: '.$ps['nama'].'</strong><br>';
              echo '<em>'.$ps['email'].'</em><br>';
              echo substr($ps['pesan'],0,100).'...';
              echo '</div>';
            }
            echo '<a href="pesan.php" class="btn btn-sm btn-secondary">Lihat semua pesan</a>';
          } else {
            echo '<p>Belum ada pesan.</p>';
          }
          ?>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
      <!-- Kategori / Dusun -->
      <div class="card mb-3">
        <div class="card-header">Kategori / Dusun</div>
        <div class="card-body">
          <?php
          $kategori = $conn->query("SELECT * FROM kategori_desa ORDER BY id ASC");
          if($kategori && $kategori->num_rows > 0){
            echo '<ul class="list-group">';
            while($k = $kategori->fetch_assoc()){
              echo '<li class="list-group-item"><a href="kategori.php?id='.$k['id'].'">'.$k['nama_dusun'].'</a></li>';
            }
            echo '</ul>';
          } else {
            echo '<p>Belum ada data dusun.</p>';
          }
          ?>
        </div>
      </div>
      
      <!-- Wilayah Desa -->
      <div class="card mb-3">
        <div class="card-header">Wilayah Desa Carangrejo</div>
        <div class="card-body">
          <div id="map" style="height:300px; width:100%;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Leaflet Map Script -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  var map = L.map('map').setView([-7.5566, 112.2830], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
  }).addTo(map);

  var marker = L.marker([-7.5566, 112.2830]).addTo(map);
  marker.bindPopup("<b>Desa Carangrejo</b><br>Kesamben, Jombang, Jawa Timur 61484").openPopup();
</script>

<?php 
include '../includes/footer.php'; 
$conn->close(); 
?>
