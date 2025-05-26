<?php
session_start();
$thank_you_msg = '';
if (isset($_SESSION['thank_you'])) {
    $thank_you_msg = $_SESSION['thank_you'];
    unset($_SESSION['thank_you']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
    <style>
        /* Gradient Background */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg,rgb(191, 193, 204), #764ba2); /* Purple Gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            top:10px;
        }

        /* Feedback Form Container */
        .container {
            background: rgba(255, 255, 255, 0.3); /* Glassmorphism Effect */
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: white;
            margin-bottom: 15px;
        }

        /* Input Fields */
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            color: black;
            text-align: left;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.8);
            font-size: 16px;
        }

        /* Submit Button */
        button {
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #218838;
        }

        /* Success Popup */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1000;
        }

        .popup h3 {
            color: #28a745;
            margin-bottom: 10px;
        }

        .popup button {
            background: #007bff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .popup button:hover {
            background: #0056b3;
        }

        /* Success Message */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submit Feedback</h2>

        <!-- Success Message Display -->
        <?php if (!empty($thank_you_msg)): ?>
            <div class="alert-success">
                <?= htmlspecialchars($thank_you_msg) ?>
            </div>
        <?php endif; ?>

        <form action="submit_feedback.php" method="POST" onsubmit="return validateForm()">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" required pattern="^\d{10}$" title="Phone number must be 10 digits">

            <label for="rating">Rating (1 to 5):</label>
            <select name="rating" required>
                <option value="0"></option>
                <option value="1">Excellent🤩</option>
                <option value="2">Very Good 🙂</option>
                <option value="3">Good😐</option>
                <option value="4">Fair😞</option>
                <option value="5">Poor😡</option>
            </select>

            <label for="comments">Comments:</label>
            <textarea name="comments" placeholder="Write your feedback..." required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>

        <!-- Success Popup (Hidden by default) -->
        <div class="overlay" id="overlay">
            <div class="popup">
                <h3>Thank You for Your Feedback!</h3>
                <button onclick="closePopup()">Close</button>
            </div>
        </div>
    </div>
    <br>
        
		<a href="./index.php">Back to Home</a>
    <script>
        // Validate the form before submission
        function validateForm() {
            const phone = document.getElementById("phone");
            const rating = document.querySelector("select[name='rating']");

            // Check if phone is valid
            if (!phone.value.match(/^\d{10}$/)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }

            // Check if rating is selected
            if (rating.value == "0") {
                alert("Please select a rating.");
                return false;
            }

            // Display the success popup
            document.getElementById("overlay").style.display = "block";
            return true;
        }

        // Close the success popup
        function closePopup() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>
</html>
