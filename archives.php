<?php
include 'config/db.php';

$sql = "SELECT * FROM events WHERE event_date < NOW() ORDER BY event_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Archived Events</h1>
    </header>

    <div id="archivedEvents">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='event' style='background-color: " . $row["color"] . ";'>";
                echo "<h3>" . $row["name"] . " " . ($row["emoji"] ? $row["emoji"] : "") . "</h3>";
                echo "<p>Event date: " . $row["event_date"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No archived events.</p>";
        }
        ?>
    </div>

    <footer>
        <button onclick="window.location.href='index.php'">Back to Active Events</button>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
