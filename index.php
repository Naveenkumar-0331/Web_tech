<?php
include 'config/db.php';

$sql = "SELECT * FROM events WHERE event_date > NOW() ORDER BY event_date ASC";
$result = $conn->query($sql);

function calculateCountdown($eventDate) {
    $now = new DateTime();
    $eventDateTime = new DateTime($eventDate);
    $interval = $now->diff($eventDateTime);
    
    return $interval->format('%d days %h hours %i minutes');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown Timer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Countdown Events</h1>
        <button onclick="window.location.href='create_event.php'">Create New Event</button>
    </header>
    
    <main id="eventsList">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='event' style='background-color: " . $row["color"] . ";'>";
                echo "<h3>" . $row["name"] . " " . ($row["emoji"] ? $row["emoji"] : "") . "</h3>";
                echo "<p>Time left: " . calculateCountdown($row["event_date"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No upcoming events.</p>";
        }
        ?>
    </main>

    <footer>
        <button onclick="window.location.href='archives.php'">View Archived Events</button>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
