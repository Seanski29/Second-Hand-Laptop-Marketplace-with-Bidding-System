<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
require_once 'server/connection.php';
require_once 'server/session.php';
require_once 'server/win.php';

$session = new Session();
$user_id = $session->get('user_id');

// Include the file to fetch products
$get_products = include('server/fetch_products.php');

// Fetch products with the latest bid information
$query = "SELECT p.*, COALESCE(MAX(pb.high_bid_amount), p.starting_price) AS highest_bid, pb.user_id AS bidder_id 
          FROM products p 
          LEFT JOIN pending_bid pb ON p.product_id = pb.product_id 
          GROUP BY p.product_id 
          ORDER BY p.bid_deadline ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <img src="assets/images/Logo.webp?v=2" width="85" height="75" alt="assets/images/Logo.webp">
        <a class="navbar-brand" href="#">LaptopHaven</a>
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

<!-- START OF MARKET SECTION -->
<div text-center>
    <h1 class="text-center mb-4 pt-5">Laptop Market</h1>
</div>
<section id="brand" class="container py-5">
    <div class="row product-card-container">
        <!-- DB connection get products -->
        <?php foreach ($products as $row): ?>
        <!-- Products -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4 product-card">
            <div class="card h-100 d-flex flex-column">
                <img class="card-img-top product-image" alt="LAPTOP" src="assets/images/<?php echo htmlspecialchars($row['product_image']); ?>" onerror="this.onerror=null; this.src='assets/images/default.jpg';"/>
                <div class="card-body d-flex flex-column">
                    <h3 class="product-title"><?php echo $row['product_name']; ?></h3>
                    <p class="product-description"><?php echo $row['product_description']; ?></p>
                    <p class="starting-price">Starting Price: $<?php echo $row['starting_price']; ?></p>
                    <p class="highest-bid">Highest Bid: $<?php echo $row['highest_bid']; ?></p>
                    <p class="bid_deadline">Bidding Deadline: <?php echo $row['bid_deadline']; ?></p>
                    <?php if ($row['status'] == 'sold'): ?>
                        <button class="btn btn-secondary w-100 mt-auto" disabled>Sold</button>
                    <?php elseif ($session->isLoggedIn() && $row['user_id'] != $user_id): ?>
                        <a href="bid.php?product_id=<?php echo urlencode($row['product_id']); ?>"><button class="btn btn-primary w-100 mt-auto">Enter Bid</button></a>
                    <?php elseif ($session->isLoggedIn() && $row['user_id'] == $user_id): ?>
                        <button class="btn btn-secondary w-100 mt-auto" disabled>Your Product</button>
                    <?php else: ?>
                        <a href="login.php"><button class="btn btn-primary w-100 mt-auto">Enter Bid</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<!-- END OF MARKET SECTION -->

<!-- FOOTER -->
<footer class="mt-5 py-5 bg-dark text-white">
    <div class="container">
        <!-- Footer content -->
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
