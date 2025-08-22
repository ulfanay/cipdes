<?php
include '../includes/db.php'; // koneksi database

// Tambah data
if (isset($_POST['tambah'])) {
    $visi = mysqli_real_escape_string($conn, $_POST['visi']);
    $misi = mysqli_real_escape_string($conn, $_POST['misi']);
    $query = "INSERT INTO visi_misi (visi, misi) VALUES ('$visi', '$misi')";
    mysqli_query($conn, $query);
    header("Location: visi_misi.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM visi_misi WHERE id=$id");
    header("Location: visi_misi.php");
    exit;
}

// Edit data
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $visi = mysqli_real_escape_string($conn, $_POST['visi']);
    $misi = mysqli_real_escape_string($conn, $_POST['misi']);
    $query = "UPDATE visi_misi SET visi='$visi', misi='$misi' WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: visi_misi.php");
    exit;
}

// Ambil semua data
$result = mysqli_query($conn, "SELECT * FROM visi_misi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Visi & Misi Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2 class="mb-3">Manajemen Visi & Misi Desa</h2>
    <a href="index.php" class="btn btn-secondary mb-3">⬅ Kembali ke Dashboard</a>

    <!-- Form Tambah -->
    <div class="card mb-4">
        <div class="card-header">Tambah Visi & Misi</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea name="visi" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Misi</label>
                    <textarea name="misi" class="form-control" required></textarea>
                </div>
                <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Visi</th>
                <th>Misi</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= nl2br(htmlspecialchars($row['visi'])); ?></td>
                <td><?= nl2br(htmlspecialchars($row['misi'])); ?></td>
                <td><?= $row['created_at']; ?></td>
                <td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id']; ?>">Edit</button>
                    
                    <!-- Tombol Hapus -->
                    <a href="?hapus=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?');">Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Visi & Misi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <textarea name="visi" class="form-control" required><?= htmlspecialchars($row['visi']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Misi</label>
                            <textarea name="misi" class="form-control" required><?= htmlspecialchars($row['misi']); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        <?php } ?>
        </tbody>
    </table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php include '../includes/footer.php'; ?>
