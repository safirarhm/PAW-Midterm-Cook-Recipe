<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$id = $_GET['id'];
$sql = "DELETE FROM items WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: main.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>