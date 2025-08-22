<?php
include '../includes/db.php';

// Tambah data
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $kategori = $_POST['kategori'];

    $gambar = "";
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/" . $gambar);
    }

    $sql = "INSERT INTO berita (judul, isi, kategori, gambar) VALUES ('$judul', '$isi', '$kategori', '$gambar')";
    mysqli_query($conn, $sql);
    header("Location: berita.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM berita WHERE id=$id");
    header("Location: berita.php");
    exit;
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $kategori = $_POST['kategori'];

    $gambar = $_POST['gambar_lama'];
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/" . $gambar);
    }

    $sql = "UPDATE berita SET judul='$judul', isi='$isi', kategori='$kategori', gambar='$gambar' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: berita.php");
    exit;
}

// Ambil semua data berita
$result = mysqli_query($conn, "SELECT * FROM berita ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2 class="mb-4">Manajemen Berita Desa</h2>
    <a href="index.php" class="btn btn-secondary mb-3">⬅ Kembali ke Dashboard</a>

    <!-- Form tambah berita -->
    <div class="card mb-4">
        <div class="card-header">Tambah Berita</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Isi</label>
                    <textarea name="isi" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Tabel daftar berita -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Isi</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['kategori'] ?></td>
                <td>
                    <?php if ($row['gambar']): ?>
                        <img src="../uploads/<?= $row['gambar'] ?>" width="80">
                    <?php endif; ?>
                </td>
                <td><?= substr($row['isi'],0,100) ?>...</td>
                <td><?= $row['created_at'] ?></td>
                <td><?= $row['updated_at'] ?></td>
                <td>
                    <!-- Tombol edit (modal) -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id'] ?>">Edit</button>
                    <a href="berita.php?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus berita ini?')">Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="edit<?= $row['id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header">
                          <h5 class="modal-title">Edit Berita</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                          <div class="mb-3">
                              <label>Judul</label>
                              <input type="text" name="judul" class="form-control" value="<?= $row['judul'] ?>" required>
                          </div>
                          <div class="mb-3">
                              <label>Isi</label>
                              <textarea name="isi" class="form-control" rows="4" required><?= $row['isi'] ?></textarea>
                          </div>
                          <div class="mb-3">
                              <label>Kategori</label>
                              <input type="text" name="kategori" class="form-control" value="<?= $row['kategori'] ?>" required>
                          </div>
                          <div class="mb-3">
                              <label>Gambar</label>
                              <input type="file" name="gambar" class="form-control">
                              <?php if ($row['gambar']): ?>
                                  <small>Gambar saat ini: <?= $row['gambar'] ?></small>
                              <?php endif; ?>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
        </tbody>
    </table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
