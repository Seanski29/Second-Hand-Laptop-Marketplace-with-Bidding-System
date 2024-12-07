<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
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

// Handle the bid submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bid_amount = htmlspecialchars(trim($_POST['bid_amount']));

    // Check if the bid amount is higher than the starting bid
    if ($bid_amount <= $product['starting_price']) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Bid should be higher than the starting bid.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        // Insert the bid into the pending_bid table
        $query = "INSERT INTO pending_bid (product_id, user_id, high_bid_amount, bid_deadline) 
                  VALUES (:product_id, :user_id, :high_bid_amount, :bid_deadline)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':high_bid_amount', $bid_amount);
        $stmt->bindParam(':bid_deadline', $product['bid_deadline']);
        $stmt->execute();

        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Your bid has been placed successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'market.php';
                }
            });
        </script>";
    }
}
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
    <img src="assets/images/Logo.webp?v=2" width="85" height="75" alt="assets/images/Logo.webp">
    <a class="navbar-brand" href="#">       |    LaptopHaven     |      </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="market.php">Market</a></li>
                <li class "nav-item"><a class="nav-link" href="sell.php">Sell</a></li>
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
            <form method="POST" action="bid.php?product_id=<?php echo $product_id; ?>"> <!-- Updated -->
             <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
               <div class="mb-3">
                <label for="bid_amount" class="form-label">Your Bid</label>
                   <input type="number" name="bid_amount" class="form-control" required min="<?php echo $product['highest_bid'] + 1; ?>">
                    </div>
                        <button type="submit" class="btn btn-warning w-100">Send Offer</button>
                   </form>
            </form>
        </div>
    </div>
</section>
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