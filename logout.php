<?php
session_start();
session_destroy();  // Menghancurkan semua sesi
header("Location: login.php");  // Redirect ke halaman login setelah logout
exit;
?>
