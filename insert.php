<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
    $nama_masakan = $conn->real_escape_string($_POST['nama_masakan']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file gambar
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO items (nama_masakan, deskripsi, gambar) VALUES ('$nama_masakan', '$deskripsi', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                header("Location: main.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Hanya file gambar (JPG, JPEG, PNG, GIF) yang diperbolehkan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #FEF9F2;
        }

        form {
            width: 300px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form input[type="text"],
        form textarea,
        form input[type="file"],
        form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        form input[type="text"]:focus,
        form textarea:focus,
        form input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        form textarea {
            resize: vertical;
            min-height: 80px;
        }

        form button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #218838;
        }

        /* Styling for Back to Main Menu Button */
        .back-button {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #FC6736;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
        }

        .back-button:hover {
            background-color: #5f7993;
            transform: scale(1.05);
        }

        .back-button:focus {
            outline: none;
        }

    </style>
</head>
<body>

<form method="POST" action="" enctype="multipart/form-data">
    <label for="nama_masakan">Recipe Name</label>
    <input type="text" id="nama_masakan" name="nama_masakan" placeholder="Recipe Name" required>
    
    <label for="deskripsi">Ingredients</label>
    <textarea id="deskripsi" name="deskripsi" placeholder="Description..." required></textarea>
    
    <label for="gambar">Photo of your dish</label>
    <input type="file" id="gambar" name="gambar" required>
    
    <button type="submit" name="submit">Ready to Cook</button>
</form>

<!-- Back to Main Menu Button -->
<a href="main.php" class="back-button">Back</a>

</body>
</html>
