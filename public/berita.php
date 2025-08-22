<?php 
include '../includes/db.php'; 
include '../includes/header.php'; 
?>

<div class="container mt-4">
  <h2 class="mb-4">Daftar Berita Desa</h2>
  <?php
  // Jika ada parameter id => tampil detail berita
  if(isset($_GET['id'])){
      $id = (int)$_GET['id'];
      $res = $conn->query("SELECT * FROM berita WHERE id=$id");
      if($res && $res->num_rows > 0){
          $row = $res->fetch_assoc();
          echo '<div class="card mb-3">';
          if(!empty($row['gambar'])){
              echo '<img src="../uploads/'.$row['gambar'].'" class="card-img-top" alt="'.$row['judul'].'">';
          }
          echo '<div class="card-body">';
          echo '<h4>'.$row['judul'].'</h4>';
          echo '<small class="text-muted">'.$row['created_at'].' | '.$row['kategori'].'</small>';
          echo '<p class="mt-3">'.$row['isi'].'</p>';
          echo '<a href="berita.php" class="btn btn-secondary">Kembali</a>';
          echo '</div></div>';
      } else {
          echo "<p>Berita tidak ditemukan.</p>";
      }
  } else {
      // List semua berita
      $res = $conn->query("SELECT * FROM berita ORDER BY created_at DESC");
      if($res && $res->num_rows > 0){
          while($row = $res->fetch_assoc()){
              echo '<div class="card mb-3">';
              if (!empty($b['gambar'])) {
    $filePath = __DIR__ . '/../uploads/' . $b['gambar'];
    if (file_exists($filePath)) {
        $imageData = base64_encode(file_get_contents($filePath));
        $mimeType = mime_content_type($filePath);
        echo '<img src="data:'.$mimeType.';base64,'.$imageData.'" 
                  class="img-fluid rounded mb-2" 
                  alt="Gambar Berita">';
    }
} 
              echo '<div class="card-body">';
              echo '<h4 class="card-title">'.$row['judul'].'</h4>';
              echo '<small class="text-muted">'.$row['created_at'].' | '.$row['kategori'].'</small>';
              echo '<p>'.substr($row['isi'],0,150).'...</p>';
              echo '<a href="berita.php?id='.$row['id'].'" class="btn btn-danger btn-sm">Baca Selengkapnya</a>';
              echo '</div></div>';
          }
      } else {
          echo "<p>Belum ada berita.</p>";
      }
  }
  ?>
</div> 
