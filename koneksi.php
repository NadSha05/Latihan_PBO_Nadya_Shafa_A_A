<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";       // Username default XAMPP/MariaDB
$pass = "";           // Password default XAMPP/MariaDB biasanya kosong
$db   = "db_latihan_pbo_trpl1a_nadya_shafa a.a";

// Membuat Koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Memeriksa Koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil ke database!";
}
?>
