<?php
include 'db.php'; // Koneksi ke database

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password

    // Insert data ke database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil! <a href='login.php'>Login di sini</a>";
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
    <title>Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background-color: #FEF9F2; /* Updated background color */
        }

        .form-container {
            width: 400px;
            padding: 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .form-container h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            background: #f9f9f9;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #8a2387; /* Same as login button color */
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .form-container button:hover {
            background-color: #6d1f66;
        }

        .form-container p {
            margin-top: 20px;
            font-size: 14px;
        }

        .form-container p a {
            color: #8a2387;
            text-decoration: none;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Register</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Log in here</a></p>
</div>

</body>
</html>
