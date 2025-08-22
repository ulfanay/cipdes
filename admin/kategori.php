<?php
include '../includes/db.php';
session_start();

// CREATE
if (isset($_POST['tambah'])) {
    $nama_dusun = $_POST['nama_dusun'];
    $deskripsi = $_POST['deskripsi'];

    // upload gambar
    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = time() . "_" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/" . $gambar);
    }

    $sql = "INSERT INTO kategori_desa (nama_dusun, deskripsi, gambar) VALUES ('$nama_dusun', '$deskripsi', '$gambar')";
    mysqli_query($conn, $sql);
    header("Location: kategori.php");
    exit();
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_dusun = $_POST['nama_dusun'];
    $deskripsi = $_POST['deskripsi'];

    // cek gambar
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = time() . "_" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/" . $gambar);
        $sql = "UPDATE kategori_desa SET nama_dusun='$nama_dusun', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";
    } else {
        $sql = "UPDATE kategori_desa SET nama_dusun='$nama_dusun', deskripsi='$deskripsi' WHERE id=$id";
    }

    mysqli_query($conn, $sql);
    header("Location: kategori.php");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM kategori_desa WHERE id=$id");
    header("Location: kategori.php");
    exit();
}

// READ
$result = mysqli_query($conn, "SELECT * FROM kategori_desa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Kategori Dusun</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h2>Manajemen Kategori Dusun</h2>
    <a href="index.php" class="btn btn-secondary mb-3">⬅ Kembali ke Dashboard</a>

    <!-- Form Tambah Data -->
    <div class="card p-3 mb-4">
        <h4>Tambah Kategori Dusun</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Dusun</label>
                <input type="text" name="nama_dusun" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Gambar (opsional)</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Dusun</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama_dusun'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td>
                    <?php if ($row['gambar']) { ?>
                        <img src="../uploads/<?= $row['gambar'] ?>" width="80">
                    <?php } else { echo "-"; } ?>
                </td>
                <td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id'] ?>">Edit</button>
                    <a href="kategori.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="edit<?= $row['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Kategori Dusun</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <div class="mb-3">
                                    <label>Nama Dusun</label>
                                    <input type="text" name="nama_dusun" class="form-control" value="<?= $row['nama_dusun'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" required><?= $row['deskripsi'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Gambar (kosongkan jika tidak diubah)</label>
                                    <input type="file" name="gambar" class="form-control">
                                    <?php if ($row['gambar']) { ?>
                                        <small>Gambar saat ini: <?= $row['gambar'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php } ?>
        </tbody>
    </table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include '../includes/footer.php'; ?>