<?php 
ob_start();
session_start();
include '../includes/db.php'; // koneksi ke database

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // password di-hash MD5 (sesuai dummy.sql)

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $row['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
ob_end_flush(); 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIPDES - Login Admin</title>

    <!-- Bootstrap & Fontawesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 400px;
        }
        .login-box h3 {
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #2a5298;
        }
        .input-group-text {
            background: #2a5298;
            color: #fff;
            border: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #2a5298;
        }
        .btn-login {
            background: #2a5298;
            color: #fff;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #1e3c72;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h3><i class="fas fa-user-shield"></i> Admin Login</h3>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger text-center"><?= $error; ?></div>
        <?php } ?>

        <form method="POST" action="">
            <!-- Username -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <!-- Password -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-login">Login</button>
            </div>
        </form>
        
        <div class="text-center mt-3">
            <small>© <?= date('Y'); ?> CIPDES | Admin Panel</small>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
