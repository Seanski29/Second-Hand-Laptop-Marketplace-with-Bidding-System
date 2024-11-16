<?php
session_start();
include('server/connection.php');//Isasasma database conection

//To check if logged in(mmya ilalagaya)
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view this page.");
}

$user_id = $_SESSION['user_id']; // may user ID

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <script src="assets/js/alert.js"></script>
</head>
<body>
    <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <img src="assets/images/Logo.webp" width="45" height="55" alt="Logo">
        <a class="navbar-brand" href="#">LaptopHaven</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#brandings">Brands</a></li>
                <li class="nav-item"><a class="nav-link" href="market.php">Market</a></li>
                <li class="nav-item"><a class="nav-link" href="#sell.html">Sell</a></li>
                <li class="nav-item"><a class="nav-link" href="about us.html">About us</a></li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

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
    
<!-- FOOTER -->
<footer class="mt-5 py-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                    <img src="assets/images/Logo.webp" alt="LaptopHaven Logo" width="70" height="100">
                    <p class="pt-3">We are happy that you chose LaptopHaven for your second-hand laptop hunting!</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Budget-Friendly</a></li>
                        <li><a href="#">Low-End</a></li>
                        <li><a href="#">Mid-End</a></li>
                        <li><a href="#">High-End</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <h5>Contact Us</h5>
                    <div>
                        <h6>Andor</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                    <div>
                        <h6>Del Rosario</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                    <div>
                        <h6>Romero</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
