<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $rating = intval($_POST['rating']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (name, email, phone, rating, comments) 
            VALUES ('$name', '$email', '$phone', '$rating', '$comments')";

    if (mysqli_query($conn, $sql)) {
        // Send confirmation email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'vishalisuba23@gmail.com'; // Your Gmail
            $mail->Password = 'ofno twje tykk yxuv'; // Use a generated App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email content
            $mail->setFrom('vishalisuba23@gmail.com', 'PHPMailer'); // Admin email
            $mail->addReplyTo($email, $name); // User's email for replies
            $mail->addAddress($email, $name); // Send email to user
            $mail->Subject = 'Thank You for Your Feedback!';
            $mail->Body = "Dear $name,\n\nThank you for your feedback!\n\nYour Rating: $rating\nComments: $comments\n\nWe appreciate your time.\n\nBest regards,\nGovt Support Team";

            $mail->send();
            echo "Feedback submitted successfully. A confirmation email has been sent.";
        } catch (Exception $e) {
            echo "Feedback submitted, but email could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

session_start();

// Set thank you message in session
$_SESSION['thank_you'] = "Thank you for your feedback, $name!";

// Redirect back to feedback form
header("Location: feedback.php");
exit();

?>
