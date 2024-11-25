<?php
session_set_cookie_params(['samesite' => 'Strict']);  // Ensure cookies are set correctly for localhost
session_start();

require_once 'server/connection.php';

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
    <title>Pending Bid</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/alert.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
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

<!-- BID SECTION -->
<section class="container my-5 py-5">
    <h2 class="font-weight-bold">Bidding Section</h2>

    <table class="table mt-5">
        <thead>
            <tr>
                <th>Chosen Product</th>
                <th>Highest Bid</th>
                <th>Your Bid</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="assets/images/<?php echo htmlspecialchars($product['product_image']); ?>" class="img-thumbnail me-3" alt="<?php echo htmlspecialchars($product['product_name']); ?>" style="width: 100px;">
                        <div>
                            <p><?php echo htmlspecialchars($product['product_name']); ?></p>
                            <p><?php echo htmlspecialchars($product['product_description']); ?></p>
                            <small>USD <?php echo htmlspecialchars($product['starting_price']); ?></small>
                            <br>
                        </div>
                    </div>
                </td>
                <td><span>USD</span> <span class="product-price"><?php echo htmlspecialchars($product['highest_bid']); ?></span></td>
                <td>
                    <form method="POST" action="place_bid.php">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        <input type="number" name="bid_amount" class="form-control" value="<?php echo htmlspecialchars($product['starting_price']); ?>" required>
                        <button type="submit" class="btn btn-primary mt-2">Enter Bid</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</section>

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
