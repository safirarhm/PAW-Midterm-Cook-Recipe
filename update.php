<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM items WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $nama_masakan = $conn->real_escape_string($_POST['nama_masakan']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $target_file = $row['gambar']; // gunakan gambar lama jika tidak ada gambar baru

    if (!empty($_FILES["gambar"]["name"])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

        // Periksa tipe file gambar
        if (in_array($_FILES["gambar"]["type"], $allowedTypes)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                echo "Gambar berhasil diunggah.";
            } else {
                echo "Gagal mengunggah gambar.";
                exit;
            }
        } else {
            echo "File yang diunggah bukan gambar yang diperbolehkan.";
            exit;
        }
    }

    $sql = "UPDATE items SET nama_masakan='$nama_masakan', deskripsi='$deskripsi', gambar='$target_file' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: main.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Resep Masakan</title>
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

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .form-container input[type="text"],
        .form-container textarea,
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-container button[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button[type="submit"]:hover {
            background-color: #218838;
        }

        /* Styling for Back Button */
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #FC6736; /* Updated button color */
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

<h2>Recipe Upadate</h2>
<div class="form-container">
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="nama_masakan" value="<?php echo htmlspecialchars($row['nama_masakan']); ?>" required>
        <textarea name="deskripsi" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
        <input type="file" name="gambar">
        <button type="submit" name="submit">Already Updated</button>
    </form>
</div>

<!-- Back button -->
<a href="main.php" class="back-button">Back</a>

</body>
</html>
