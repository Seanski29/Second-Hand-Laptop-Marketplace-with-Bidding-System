<?php
require_once 'server/connection.php';
require_once 'server/session.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure the script stops executing
}

// Check if the product_id is set
if (!isset($_GET['product_id'])) {
    die("Product ID is required.");
}

$product_id = htmlspecialchars(trim($_GET['product_id']));

// Fetch product details
$query = "SELECT * FROM products WHERE product_id = :product_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':product_id', $product_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark">
    <div class="container-fluid bg-light-dark">
        <img src="assets/images/Logo.webp" width="45" height="55" alt="Logo">
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
                    <a class="button-navbar" href="dashboard.php">Logout</a>
                <?php else: ?>
                    <a class="button-navbar" href="login.php">Login</a>
                    <a class="button-navbar" href="register.php">Register</a>
                <?php endif; ?>
                
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- NAVBAR -->

<!-- BID SECTION -->
<section class="container my-5 py-5">
    <h2 class="font-weight-bold">Bidding Section</h2>
    <div class="row">
        <div class="col-lg-6">
            <img src="assets/images/<?php echo htmlspecialchars($product['product_image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
        </div>
        <div class="col-lg-6">
            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
            <p><?php echo htmlspecialchars($product['product_description']); ?></p>
            <p>Starting Price: $<?php echo htmlspecialchars($product['starting_price']); ?></p>
            <p>Highest Bid: $<?php echo htmlspecialchars($product['highest_bid']); ?></p>
            <p>Bidding Deadline: <?php echo htmlspecialchars($product['bid_deadline']);?></p>
            <form method="POST" action="pending_bid.php">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <div class="mb-3">
                    <label for="bid_amount" class="form-label">Your Bid</label>
                    <input type="number" name="bid_amount" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Place Bid</button>
            </form>
        </div>
    </div>
</section>
<!----FOOTER--->
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
                        <h6> Cedrick Andor</h6>
                        <p>andorced@gmail.com</p>
                    </div>
                    <div>
                        <h6>Sean Martin Del Rosario</h6>
                        <p>seanmdelrosariogmail.com</p>
                    </div>
                    <div>
                        <h6>Romero</h6>
                        <p>miguel_romero@myyahoo.com</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
