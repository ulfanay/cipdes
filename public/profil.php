<?php 
include 'includes/db.php'; 
include 'includes/header.php'; 
?>

<div class="container mt-4">
  <h2 class="mb-4">Profil Desa</h2>
  
  <?php
  // Ambil semua data profil_desa
  $res = mysqli_query($conn, "SELECT * FROM profil_desa ORDER BY id ASC");
  if(mysqli_num_rows($res) > 0){
      while($row = mysqli_fetch_assoc($res)){
          echo '<div class="card mb-3">';
          if (!empty($p['gambar'])) {
    $filePath = __DIR__ . '/../uploads/' . $p['gambar'];
    if (file_exists($filePath)) {
        $imageData = base64_encode(file_get_contents($filePath));
        $mimeType = mime_content_type($filePath);
        echo '<img src="data:'.$mimeType.';base64,'.$imageData.'" 
                  class="img-fluid rounded mb-2" 
                  alt="Gambar Profil Desa">';
    }
}

          echo '<div class="card-body">';
          echo '<h4 class="card-title">'.$row['judul'].'</h4>';
          echo '<p class="card-text">'.$row['isi'].'</p>';
          echo '</div></div>';
      }
  } else {
      echo "<p>Belum ada data profil desa.</p>";
  }
  ?>
</div>

<?php include 'includes/footer.php'; ?>
