<?php
// db.php
$host = 'localhost';       // Host database, biasanya 'localhost' untuk server lokal
$user = 'root';            // Username MySQL (default untuk XAMPP/LAMP/MAMP biasanya 'root')
$password = '';            // Password MySQL (default kosong untuk XAMPP)
$dbname = 'resep_masakan'; // Nama database yang sudah Anda buat

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
//} else {
//    echo "Koneksi berhasil!";
}
?>