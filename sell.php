<?php
require_once 'server/connection.php';
require_once 'server/crud.php';
require_once 'server/session.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure the script stops executing
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $product = new products($db); // Assuming the Product class exists and is passed the database connection

// Sanitizing and assigning values from POST data to product object properties
$product->product_name = htmlspecialchars(trim($_POST['productName']));
$product->product_description = htmlspecialchars(trim($_POST['productDescription'])); // Corrected
$product->product_image = htmlspecialchars(trim($_FILEST['productImage'])); // Corrected
$product->starting_price = htmlspecialchars(trim($_POST['startingPrice']));
$product->bid_deadline = htmlspecialchars(trim($_POST['biddingDeadline']));


// If you're using product_id manually, you can assign it like this (e.g., auto-incrementing database, don't assign product_id directly):
$product->product_id = null; // or $_POST['product_id'] if it's passed as part of the form (not recommended for user input)

if ($product->sell()) {
        echo "
        <script>
            alert('Submission Complete!');
            window.location.href = 'market.php';  // Redirect to market page after successful selling
        </script>";
    } else {
        echo "<script>
        alert('Error! Please try again.');
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <script src="assets/js/alert.js"></script>
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
                <?php endif; ?>
                <a class="button-navbar" href="register.php">Register</a>
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- NAVBAR -->
  <!-- SELL PAGE FORM -->
  <div class="container my-5">
        <h1 class="text-center mb-4">Sell Your Product</h1>
        <form method="POST" action="sell.php" enctype="multipart/form-data">
            <!-- Name of Product -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
            </div>

            <!-- Picture of Product -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Upload Product Image</label>
                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Product Description</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="5" placeholder="Provide details about the product" required></textarea>
            </div>

            <!-- Starting Price -->
            <div class="mb-3">
                <label for="startingPrice" class="form-label">Starting Price (USD)</label>
                <input type="number" class="form-control" id="startingPrice" name="startingPrice" placeholder="Enter starting price" min="0" step="0.01" required>
            </div>

            <!-- Bidding Deadline -->
            <div class="mb-3">
                <label for="biddingDeadline" class="form-label">Bidding Deadline</label>
                <input type="datetime-local" class="form-control" id="biddingDeadline" name="biddingDeadline" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Submit Product</button>
        </form>
    </div>
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

