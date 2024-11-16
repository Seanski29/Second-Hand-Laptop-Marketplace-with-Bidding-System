<?php
session_start();
include('server/connection.php'); // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to send messages.");
}

$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($sender_id, $receiver_id, '$message')";
if ($conn->query($sql) === TRUE) {
    header("Location: chat.php?receiver_id=$receiver_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>