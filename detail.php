<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM items WHERE id=$id";
$result = $conn->query($sql);
$item = $result->fetch_assoc();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
* {
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Align left */
    margin: 0;
    padding: 20px;
    background-color: #FEF9F2;
}

/* Header */
h2 {
    font-size: 28px;
    color: #333;
    text-align: left;
    margin-top: 20px;
}
/* Description text */
p {
    font-size: 16px;
    color: #555;
    text-align: left;
    margin-top: 20px;
    line-height: 1.5;
    max-width: 800px;
    word-wrap: break-word;
}

/* Image Styling */
img {
    width: 100%;
    max-width: 300px;
    height: auto;
    display: block;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Back button */
.back-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #FC6736;
    border: none;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
    margin-top: 30px;
    transition: background-color 0.3s, transform 0.2s;
}

.back-button:hover {
    background-color: #e5562e;
    transform: scale(1.05);
}

.back-button:focus {
    outline: none;
}
    </style>
</head>
<body>
    
    <h2><?php echo $item['nama_masakan']; ?></h2>
    <img src="<?php echo $item['gambar']; ?>" alt="Gambar Masakan" width="200">
    <p><?php echo $item['deskripsi']; ?></p>
    <a href="main.php" class="back-button">Kembali</a>

</body>
</html>
