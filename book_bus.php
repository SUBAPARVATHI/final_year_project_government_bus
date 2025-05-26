<?php
include("db_connect.php");
session_start();

$bus_id = $_GET['id'];

// ✅ Handle booking
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seat_id'])) {
    $seat_id = $_POST['seat_id'];
    $user_email = $_SESSION['user_email'] ?? 'guest@example.com'; // fallback if not logged in

    $update = "UPDATE seats SET is_booked = 1, booked_by_email = '$user_email' WHERE id = '$seat_id'";
    mysqli_query($conn, $update);
    echo "<p style='color: green;'>Seat $seat_id booked successfully by $user_email</p>";
}

// ✅ Get bus name
$bus_result = mysqli_query($conn, "SELECT * FROM buses WHERE id='$bus_id'");
$bus = mysqli_fetch_assoc($bus_result);
echo "<h2>🚌 Book Seat for {$bus['name']} ({$bus['source']} → {$bus['destination']})</h2>";


// ✅ Display seats
$seats_result = mysqli_query($conn, "SELECT * FROM seats WHERE bus_id='$bus_id'");
while ($seat = mysqli_fetch_assoc($seats_result)) {
    echo "<form method='post' style='display:inline-block; margin:5px;'>";
    echo "<input type='hidden' name='seat_id' value='{$seat['id']}'>";
    $color = $seat['is_booked'] ? '🟥' : '🟩';
    $disabled = $seat['is_booked'] ? 'disabled' : '';
    echo "<button type='submit' $disabled>{$color} Seat {$seat['seat_number']}</button>";
    echo "</form>";
}
?>
