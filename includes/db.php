<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cipdes";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Definisikan BASE_URL (otomatis menyesuaikan dengan XAMPP)
define("BASE_URL", "http://localhost/cipdes");
?>
