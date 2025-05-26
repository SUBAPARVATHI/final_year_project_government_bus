<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
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
        /* Background Styling */
        body {
            background: linear-gradient(135deg,rgb(191, 193, 204), #764ba2); /* Pink Gradient */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.3); /* Transparent White Background */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px); /* Glassmorphism Effect */
            text-align: center;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        /* Input Fields */
        input {
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
        }

        /* Submit Button */
        button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #218838;
        }

        /* Link Styling */
        a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>REGISTER NEW USER</h2>
        <form action="register.php" method="POST">
            <label style="color:white;">Username :</label>
            <input type="text" name="username" placeholder="Enter Username" required>

            <label style="color:white;">Password :</label>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>


