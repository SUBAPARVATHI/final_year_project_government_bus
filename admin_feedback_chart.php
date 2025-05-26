<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "obrsphp"; // use your DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get feedback count per rating
$sql = "SELECT rating, COUNT(*) AS count FROM feedback GROUP BY rating ORDER BY rating ASC";
$result = $conn->query($sql);

$ratings = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $ratings[] = "Rating " . $row['rating'];
    $counts[] = $row['count'];
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            background:rgb(0, 0, 0);
            padding: 40px;
        }

        canvas {
            max-width: 600px;
            margin: 30px auto;
        }

        h2 {
            color: #333;
        }
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
            background: rgba(248, 40, 40, 0.3); /* Glassmorphism Effect */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: black(10px); /* Blurry Background */
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
            background: rgba(255, 107, 107, 0.8);
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
    <h2>User Feedback Overview</h2>
    <canvas id="feedbackChart"></canvas>
    <script>
    const ctx = document.getElementById('feedbackChart').getContext('2d');
    const feedbackChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($ratings); ?>,
            datasets: [{
                label: 'Number of Feedbacks',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: '#b2ebf2',
                borderColor: '#ffffff',
                borderWidth: 4,
                borderRadius: 10
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0,
                    ticks: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.3)',
                        lineWidth: 2
                    }
                },
                x: {
                    ticks: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.3)',
                        lineWidth: 2
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>
