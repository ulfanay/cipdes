<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM profil WHERE id=$id");
$row = mysqli_fetch_assoc($result);

// Update data
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "uploads/" . $gambar);
        $query = "UPDATE profil SET judul='$judul', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";
    } else {
        $query = "UPDATE profil SET judul='$judul', deskripsi='$deskripsi' WHERE id=$id";
    }

    mysqli_query($conn, $query);
    header("Location: dataprofil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Edit Profil Desa</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= $row['judul']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required><?= $row['deskripsi']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Gambar</label><br>
            <img src="uploads/<?= $row['gambar']; ?>" width="150"><br><br>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="dataprofil.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
