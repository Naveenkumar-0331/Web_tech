<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id=$_POST['event_id'];
    $name = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $color = $_POST['eventColor'];
    $emoji = $_POST['eventEmoji'];

    // Handle background image upload
    $background = null;
    if (isset($_FILES['eventBackground']) && $_FILES['eventBackground']['error'] == 0) {
        $background = 'upload/' . basename($_FILES['eventBackground']['name']);
        move_uploaded_file($_FILES['eventBackground']['tmp_name'], $background);
    }

    $sql = "INSERT INTO events (id,name, event_date, color, emoji, background) 
            VALUES ('$id','$name', '$eventDate', '$color', '$emoji', '$background')";

    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Create New Countdown Event</h1>
    </header>

    <form method="POST" enctype="multipart/form-data">
        <label for="event_id">Event Id:</label>
        <input type="text" name="event_id" id="event_id" required>
        <label for="eventName">Event Name:</label>
        <input type="text" name="eventName" id="eventName" required>

        <label for="eventDate">Event Date:</label>
        <input type="datetime-local" name="eventDate" id="eventDate" required>

        <label for="eventColor">Event Color:</label>
        <input type="color" name="eventColor" id="eventColor">

        <label for="eventEmoji">Emoji:</label>
        <input type="text" name="eventEmoji" id="eventEmoji">

        <label for="eventBackground">Background Image:</label>
        <input type="file" name="eventBackground" id="eventBackground">

        <button type="submit">Create Event</button>
    </form>

    <footer>
        <button onclick="window.location.href='index.php'">Back to Events</button>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
