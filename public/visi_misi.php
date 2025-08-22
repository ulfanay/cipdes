<?php 
include '../includes/db.php'; 
include '../includes/header.php'; 
?>

<div class="container mt-4">
  <h2 class="mb-4">Visi & Misi Desa</h2>
  <?php
  $res = $conn->query("SELECT * FROM visi_misi ORDER BY id DESC LIMIT 1");
  if($res && $res->num_rows > 0){
      $row = $res->fetch_assoc();
      echo '<div class="card">';
      echo '<div class="card-body">';
      echo '<h4>Visi</h4><p>'.$row['visi'].'</p>';
      echo '<h4>Misi</h4><p>'.nl2br($row['misi']).'</p>';
      echo '</div></div>';
  } else {
      echo "<p>Belum ada data visi & misi.</p>";
  }
  ?>
</div>

<?php include '../includes/footer.php'; ?>
