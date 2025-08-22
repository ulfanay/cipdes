<?php
session_start();
include("../includes/db.php");

// Cek login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Tambah data
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "uploads/" . $gambar;

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO profil (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')";
        mysqli_query($conn, $query);
    }
    header("Location: dataprofil.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM profil WHERE id=$id");
    header("Location: dataprofil.php");
    exit;
}

// Ambil data
$data = mysqli_query($conn, "SELECT * FROM profil ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Profil Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h2>Manajemen Profil Desa</h2>
    <a href="index.php" class="btn btn-secondary btn-sm mb-3">⬅ Kembali ke Dashboard</a>

    <!-- Form tambah data -->
    <div class="card mb-4">
        <div class="card-header">Tambah Profil</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Tabel data -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while ($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['deskripsi']; ?></td>
                <td><img src="uploads/<?= $row['gambar']; ?>" width="120"></td>
                <td>
                    <a href="editprofil.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="dataprofil.php?hapus=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
