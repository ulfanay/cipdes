<?php
include '../includes/db.php';

// Tambah pesan
if (isset($_POST['add'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $sql = "INSERT INTO pesan (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    mysqli_query($conn, $sql);
    header("Location: pesan.php");
    exit;
}

// Update pesan
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $sql = "UPDATE pesan SET nama='$nama', email='$email', pesan='$pesan' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: pesan.php");
    exit;
}

// Hapus pesan
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM pesan WHERE id=$id");
    header("Location: pesan.php");
    exit;
}

// Ambil semua pesan
$result = mysqli_query($conn, "SELECT * FROM pesan ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Manajemen Pesan</h2>
    <a href="index.php" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>

    <!-- Form tambah pesan -->
    <div class="card mb-4">
        <div class="card-header">Tambah Pesan</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Pesan</label>
                    <textarea name="pesan" class="form-control" required></textarea>
                </div>
                <button type="submit" name="add" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Tabel daftar pesan -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <!-- Tombol edit modal -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</button>
                    <a href="pesan.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                </td>
            </tr>

            <!-- Modal edit -->
            <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Pesan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Pesan</label>
                                <textarea name="pesan" class="form-control" required><?= htmlspecialchars($row['pesan']) ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include '../includes/footer.php'; ?>