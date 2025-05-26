<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to submit a report.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $issue = mysqli_real_escape_string($conn, $_POST['issue']);

    $sql = "INSERT INTO reports (user_id, issue) VALUES ('$user_id', '$issue')";
    if (mysqli_query($conn, $sql)) {
        echo "Report submitted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
