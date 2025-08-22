<?php
require_once '../includes/db.php';
require_once '../includes/header.php';
?>

<main class="flex-shrink-0">
<div class="container mt-4 mb-5">

  <?php if (isset($_GET['id'])): ?>
      <?php
      // DETAIL DUSUN
      $id = intval($_GET['id']);
      $sql = $conn->query("SELECT * FROM kategori_desa WHERE id = $id LIMIT 1");
      ?>
      <?php if ($sql && $sql->num_rows > 0): ?>
          <?php $dusun = $sql->fetch_assoc(); ?>
          <div class="card shadow-sm">
              <div class="card-body">
                  <h2 class="mb-3"><?php echo $dusun['nama_dusun']; ?></h2>
                  <?php if (!empty($dusun['gambar'])): ?>
                      <img src="../uploads/<?php echo $dusun['gambar']; ?>" 
                           class="img-fluid rounded mb-3" 
                           alt="<?php echo $dusun['nama_dusun']; ?>">
                  <?php endif; ?>
                  <p class="lead"><?php echo nl2br($dusun['deskripsi']); ?></p>
                  <a href="kategori.php" class="btn btn-secondary mt-3">← Kembali ke Daftar Dusun</a>
              </div>
          </div>
      <?php else: ?>
          <div class="alert alert-danger">Dusun tidak ditemukan.</div>
          <a href="kategori.php" class="btn btn-secondary">Kembali</a>
      <?php endif; ?>

  <?php else: ?>
      <!-- LIST SEMUA DUSUN -->
      <h2 class="mb-4">Daftar Dusun</h2>
      <div class="row">
        <?php
        $dusun = $conn->query("SELECT * FROM kategori_desa ORDER BY id ASC");
        if ($dusun && $dusun->num_rows > 0):
            while ($d = $dusun->fetch_assoc()):
        ?>
          <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title"><?php echo $d['nama_dusun']; ?></h5>
                <p class="card-text text-muted"><?php echo substr($d['deskripsi'], 0, 80); ?>...</p>
              </div>
              <div class="card-footer bg-transparent border-0">
                <a href="kategori.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm">Lihat Detail</a>
              </div>
            </div>
          </div>
        <?php
            endwhile;
        else:
            echo '<p>Belum ada data dusun.</p>';
        endif;
        ?>
      </div>
  <?php endif; ?> 
</div> 
</main>

 
