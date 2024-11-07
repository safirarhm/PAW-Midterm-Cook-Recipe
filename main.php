<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep Masakan</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
            background-color: #FEF9F2;
        }

        h2 {
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        .add-button {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-button:hover {
            background-color: #218838;
        }

        .grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        width: 100%;
        padding: 20px;
        justify-content: center;
        }

        .grid-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
            transition: transform 0.3s;
        }

        .grid-item:hover {
            transform: translateY(-5px);
        }

        .grid-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .grid-item h3 {
            font-size: 16px;
            color: #333;
            margin: 0;
            margin-bottom: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 10px;
        }

        .action-buttons a {
            font-size: 14px;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .action-buttons a.detail {
            background-color: #FF4191;
        }

        .action-buttons a.update {
            background-color: #474F7A;
        }

        .action-buttons a.delete {
            background-color: #dc3545;
        }

        .action-buttons a.detail:hover {
            background-color: #5f7993;
        }

        .action-buttons a.update:hover {
            background-color: #5f7993;
        }

        .action-buttons a.delete:hover {
            background-color: #c82333;
        }

        /* Styling for Log Out Button */
        .logout-button {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 12px;
            color: #fff;
            background-color: #FC6736; 
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
        }

        .logout-button:hover {
            background-color: #e5562e;
            transform: scale(1.05);
        }

        .logout-button:focus {
            outline: none;
        }

    </style>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<a href="insert.php" class="add-button">+ Add Recipe</a>

<div class="grid-container">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="grid-item">
            <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Masakan">
            <h3><?php echo htmlspecialchars($row['nama_masakan']); ?></h3>
            <div class="action-buttons">
                <a href="detail.php?id=<?php echo $row['id']; ?>" class="detail">Detail</a>
                <a href="update.php?id=<?php echo $row['id']; ?>" class="update">Update</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Log Out Button -->
<a href="logout.php" class="logout-button">Log Out</a>

</body>
</html>
