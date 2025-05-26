<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php"); // Redirect after login
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Ensure this path is correct -->
    <style>
        /* General Page Styles */
        body {
            font-family: "Arial", sans-serif;
            background: linear-gradient(135deg,rgb(191, 193, 204), #764ba2); /* Gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Login Form Container */
        .container {
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 350px;
            backdrop-filter: blur(10px); /* Blur effect */
        }

        h2 {
            color: white;
            margin-bottom: 20px;
            font-size: 24px;
        }

        /* Input Fields */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
        }

        /* Login Button */
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        button:hover {
            background: #218838;
        }

        /* Error Message */
        .error {
            color: #ff4d4d;
            font-size: 14px;
            margin-bottom: 15px;
        }

    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>

<form action="login.php" method="POST">
    <label>Username</label>
    <input type="text" name="username" placeholder="Enter Username" required></br></br></br>
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter Password" required></br></br></br>
    <button type="submit">Login</button>
</form>

</div>
</body>
</html>