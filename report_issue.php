<?php

if (!isset($_SESSION['user_id'])) {
    echo "<p style='color:red;'>Please log in to report an issue.</p>";
    exit;
}
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Report Issue</title>
</head>
<body>
    <h2>Report an Issue</h2>
    <form action="submit_report.php" method="POST">
        <textarea name="issue" placeholder="Describe the issue..." required></textarea>
        <button type="submit">Submit Report</button>
    </form>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
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
            background: rgba(255, 255, 255, 0.3); /* Glassmorphism Effect */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px); /* Blurry Background */
            text-align: center;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        /* Input Fields */
        input, textarea {
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Report an Issue</h2>
        <!-- <form action="submit_report.php" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="description" placeholder="Describe your issue" rows="4" required></textarea>
            <button type="submit">Submit</button>
        </form> -->
        <form action="submit_report.php" method="POST">
        <textarea name="issue" placeholder="Describe the issue..." required></textarea>
        <button type="submit">Submit Report</button>
        <br>
        <br>
        <br>
		<a href="./index.php">Back to Home</a>
    </form>
    </div>
</body>
</html>

