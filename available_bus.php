<?php
include 'db_connect.php'; // adjust path if needed
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Buses</title>
    <style>
        body {
            font-family: Arial;
            background: #f3f3f3;
            padding: 20px;
        }
        .bus-card {
            background: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
        }
        .bus-card h3 {
            margin: 0 0 10px;
        }
        .book-link {
            padding: 8px 12px;
            background: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<h2>🚌 Available Buses & Seat Booking</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM buses");
if (mysqli_num_rows($result) == 0) {
    echo "<p>No buses available at the moment.</p>";
}
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='bus-card'>
        <h3>{$row['name']}</h3>
        <p>Route: <strong>{$row['source']} → {$row['destination']}</strong></p>
        <p>Total Seats: {$row['total_seats']}</p>
        <a class='book-link' href='book_bus.php?id={$row['id']}'>Book Now</a>
    </div>";
}
?>

</body>
</html>
