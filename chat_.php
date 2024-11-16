<?php
session_start();
include('server/connection.php'); // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view this page.");
}

$user_id = $_SESSION['user_id']; // Assuming you have user_id stored in session

// Check if receiver_id (seller_id) is passed as a query parameter
if (!isset($_GET['receiver_id'])) {
    die("Receiver ID is required to start a chat.");
}

$receiver_id = $_GET['receiver_id']; // Assuming receiver_id is passed as a query parameter

// Fetch messages between the user and the receiver
$sql = "SELECT * FROM messages WHERE (sender_id = $user_id AND receiver_id = $receiver_id) OR (sender_id = $receiver_id AND receiver_id = $user_id) ORDER BY timestamp ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Chat with User</h2>
        <div class="chat-box">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="message">
                    <strong><?php echo $row['sender_id'] == $user_id ? 'You' : 'User'; ?>:</strong>
                    <p><?php echo htmlspecialchars($row['message']); ?></p>
                    <span><?php echo $row['timestamp']; ?></span>
                </div>
            <?php endwhile; ?>
        </div>
        <form action="send_message.php" method="POST">
            <input type="hidden" name="sender_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
            <textarea name="message" class="form-control" placeholder="Type your message here..."></textarea>
            <button type="submit" class="btn btn-primary mt-2">Send</button>
        </form>
    </div>
</body>
</html>