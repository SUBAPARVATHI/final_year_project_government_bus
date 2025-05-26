<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Your PHP and HTML code here -->

<?php
include('db_connect.php');
session_start();


// Optional: check if admin is logged in

$result = mysqli_query($conn, "
    SELECT s.seat_number, s.booked_by_email, s.bus_id, b.name AS bus_name, b.source, b.destination
    FROM seats s
    JOIN buses b ON s.bus_id = b.id
    WHERE s.is_booked = 1
    ORDER BY s.bus_id, s.seat_number
");


echo "</br>";
echo "<h2 align = 'center'>🧾 All Booked Seats</h2>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "<table border='1' cellpadding='10' align = 'center'>";
echo "<tr><th>Bus</th><th>Route</th><th>Seat</th><th>Booked By</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['bus_name']}</td>
            <td>{$row['source']} → {$row['destination']}</td>
            <td>Seat {$row['seat_number']}</td>
            <td>{$row['booked_by_email']}</td>
          </tr>";
}

echo "</table>";
?>
</body>
</html>
