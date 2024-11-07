<?php
include 'db.php'; // Koneksi ke database
session_start(); // Mulai sesi

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query cek user
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: main.php"); // Arahkan ke halaman utama
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Center the content and set background */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background-color: #FEF9F2;
        }

        .main {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            width: 100%;
            height: 40px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            outline: none;
            background: #f9f9f9;
        }

        button {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            background-color: #8a2387;
            color: white;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #6d1f66;
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #8a2387;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="main">
        <!-- Form Login -->
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>

        <!-- Tambahkan tautan ke halaman register -->
        <p>Don't have an account? <a href="register.php">Sign up here</a></p>
    </div>
</body>
</html>
