<?php include 'includes/header.php'; ?>

<?php
$id = intval($_GET['id']);
$sql = "SELECT b.*, a.nama_lengkap AS penulis 
        FROM berita b
        LEFT JOIN admin a ON b.id_admin = a.id_admin
        WHERE b.id_berita=$id";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
  $row = $res->fetch_assoc();
?>
  <h2><?= $row['judul']; ?></h2>
  <p class="text-muted"><small>By <?= $row['penulis']; ?> | <?= date("d M Y", strtotime($row['tanggal'])); ?></small></p>
  <?php if($row['gambar']) { ?>
    <img src="uploads/<?= $row['gambar']; ?>" class="img-fluid mb-3" alt="<?= $row['judul']; ?>">
  <?php } ?>
  <p><?= nl2br($row['isi']); ?></p>
<?php
} else {
  echo "<p>Berita tidak ditemukan.</p>";
}
?>

<?php include 'includes/footer.php'; ?>
