<?php 
//include 'admin_navbar.php';  
include 'db_connect.php';  

$result = mysqli_query($conn, "SELECT reports.id, users.username, reports.issue, reports.status, reports.created_at 
                               FROM reports 
                               JOIN users ON reports.user_id = users.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Reports</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Ensure this path is correct -->
</head>
<body>
    <div class="container">
        <h2>View Reports</h2>
        <table border="1">
            <tr>
                <th>User</th>
                <th>Issue</th>
                <th>Status</th>
                <th>Reported At</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['issue']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
