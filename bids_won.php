<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIDS WON</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
session_start();
require_once 'server/connection.php';
require_once 'server/session.php';
require_once 'server/crud.php';
require_once 'server/win.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user_id = $_SESSION['user_id'];

$query = "SELECT bw.*, p.product_name, p.product_image, p.product_description, u.address 
          FROM bids_won bw 
          JOIN products p ON bw.product_id = p.product_id 
          JOIN users u ON bw.user_id = u.user_id 
          WHERE bw.user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$bidsWon = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <img src="assets/images/Logo.webp?v=2" width="85" height="75" alt="assets/images/Logo.webp">
        <a class="navbar-brand" href="#"> | LaptopHaven | </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="market.php">Market</a></li>
                <li class="nav-item"><a class="nav-link" href="sell.php">Sell</a></li>
                <li class="nav-item"><a class="nav-link" href="about us.php">About Us</a></li>
            </ul>
            <form class="d-flex">
                <?php if ($session->isLoggedIn()): ?>
                    <a class="button-navbar" href="dashboard.php">Account</a>
                <?php else: ?>
                    <a class="button-navbar" href="login.php">Login</a>
                    <a class="button-navbar" href="register.php">Register</a>
                <?php endif; ?>
            </form>
            <form class="d-flex" method="GET" action="search.php">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" required>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- END OF NAVBAR -->

<div class="container my-5">
    <h1 class="mb-4 pt-5">Bids Won</h1>
    <?php if (!empty($bidsWon)): ?>
        <?php if (isset($bidsWon[0]['address'])): ?>
            <p>Your purchased products will be shipped to this address from our Warehouse: <?php echo htmlspecialchars($bidsWon[0]['address']); ?></p>
        <?php else: ?>
            <p>Address not available.</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($bidsWon): ?>
        <div class="row">
            <?php foreach ($bidsWon as $wonBid): ?>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4 product-card">
                    <div class="card h-100 d-flex flex-column">
                        <img class="card-img-top product-image" alt="LAPTOP" src="assets/images/<?php echo $wonBid['product_image']; ?>"/>
                        <div class="card-body d-flex flex-column">
                            <h3 class="product-title"><?php echo $wonBid['product_name']; ?></h3>
                            <p class="product-description"><?php echo $wonBid['product_description']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>You haven't won any bids yet.</p>
    <?php endif; ?>
</div>

<!-- FOOTER -->
<footer class="mt-5 py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <!-- Logo and Description Section -->
            <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                <img src="assets/images/Logo.webp?v=2" alt="LaptopHaven Logo" width="175" height="155">
                <p class="pt-3">We are happy that you chose LaptopHaven for your second-hand laptop hunting!</p>
            </div>

            <!-- Contact Us Section aligned to the right -->
            <div class="col-lg-6 col-md-6 col-sm-12 text-lg-end text-md-end">
                <h5>Contact Us</h5>
                <div>
                    <h6>Cedrick Andor</h6>
                    <p>andorced@gmail.com</p>
                </div>
                <div>
                    <h6>Sean Del Rosario</h6>
                    <p>seanmdelrosariogmail.com</p>
                </div>
                <div>
                    <h6>Miguel Romero</h6>
                    <p>miguel_romero@myyahoo.com</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>