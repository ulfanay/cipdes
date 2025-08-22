<?php 
include '../includes/db.php'; 
include '../includes/header.php'; 
?>

<div class="container mt-4">
  <h2 class="mb-4">Pesan & Pengumuman</h2>
  <?php
  $res = $conn->query("SELECT * FROM pesan ORDER BY created_at DESC");
  if($res && $res->num_rows > 0){
      while($row = $res->fetch_assoc()){
          echo '<div class="alert alert-info mb-3">';
          echo '<strong>Dari: '.$row['nama'].'</strong> ('.$row['email'].')<br>';
          echo '<small>'.$row['created_at'].'</small>';
          echo '<p class="mt-2">'.$row['pesan'].'</p>';
          echo '</div>';
      }
  } else {
      echo "<p>Belum ada pesan atau pengumuman.</p>";
  }
  ?>
</div> 
