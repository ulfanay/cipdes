<?php
include '../includes/db.php'; 

// CREATE
if (isset($_POST['create'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = time() . '_' . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], '/cipdes/uploads/' . $gambar);
    }

    $sql = "INSERT INTO profil_desa (judul, isi, gambar) VALUES ('$judul', '$isi', '$gambar')";
    mysqli_query($conn, $sql);
    header("Location: profil.php");
    exit();
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    $gambar = $_POST['gambar_lama'];
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = time() . '_' . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $gambar);
    }

    $sql = "UPDATE profil_desa SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: profil.php");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM profil_desa WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: profil.php");
    exit();
}

// READ
$result = mysqli_query($conn, "SELECT * FROM profil_desa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Profil Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2>Kelola Profil Desa</h2>

    <!-- Tombol Kembali -->
    <a href="index.php" class="btn btn-secondary mb-3">⬅ Kembali ke Dashboard</a>

    <!-- Form Tambah Data -->
    <form action="" method="post" enctype="multipart/form-data" class="mb-4">
        <div class="mb-2">
            <input type="text" name="judul" placeholder="Judul" class="form-control" required>
        </div>
        <div class="mb-2">
            <textarea name="isi" placeholder="Isi Profil" class="form-control" required></textarea>
        </div>
        <div class="mb-2">
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" name="create" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Isi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['isi'] ?></td>
            <td>
                <?php if ($row['gambar']) { ?>
                    <img src="/cipdes/uploads/<?= $row['gambar'] ?>" width="100">
                <?php } ?>
            </td>
            <td>
                <!-- Form Edit -->
                <form action="" method="post" enctype="multipart/form-data" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="text" name="judul" value="<?= $row['judul'] ?>" class="form-control mb-1">
                    <textarea name="isi" class="form-control mb-1"><?= $row['isi'] ?></textarea>
                    <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                    <input type="file" name="gambar" class="form-control mb-1">
                    <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                </form>
                <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
<?php include '../includes/footer.php'; ?>