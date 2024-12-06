<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
session_start();
require_once 'server/connection.php';
require_once 'server/session.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Fetch products for logged-in user
$query = "SELECT * FROM products WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<div class="container pt-4">
        <h2>Welcome, <?php echo htmlspecialchars($session->get('user_name')); ?>!</h2>
        <p>You are logged in as <?php echo htmlspecialchars($session->get('user_email')); ?>.</p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
<!-- My Listings -->
<div class="pt-5">
    <h1 class="mb-4 pt-5">My Listings</h1>
    <a href="pending_bid.php">
                <button class="btn-primary">view pending bids</button>
            </a>
</div>
<section id="brand" class="container py-5">
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <!-- Product Card -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card d-flex flex-column">
                        <!-- Product Image -->
                        <img 
                            class="card-img-top product-image" 
                            alt="Product Image" 
                            src="assets/images/<?php echo htmlspecialchars($product['product_image']); ?>" 
                            onerror="this.onerror=null; this.src='assets/images/default.jpg';"/>
                        
                        <!-- Product Details -->
                        <div class="card-body d-flex flex-column">
                            <h3 class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <p class="product-description"><?php echo htmlspecialchars($product['product_description']); ?></p>
                            <p class="starting-price">Starting Price: $<?php echo htmlspecialchars($product['starting_price']); ?></p>
                            <p class="highest-bid">Highest Bid: $<?php echo htmlspecialchars($product['highest_bid']); ?></p>
                            <p class="bid_deadline">Bidding Deadline: <?php echo htmlspecialchars($product['bid_deadline']); ?></p>
                            <!-- Delete/Edit Buttons -->
                            <div class="text-center mt-2">
                                <form method="POST" action="#" onsubmit=""> <!--lalagyan ng shit -->
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" class="btn btn-warning w-100">Edit</button>
                                </form>
                                <form method="POST" action="server/delete_product.php" onsubmit="return confirmDelete(this);">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger w-100 mt-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</section>


    <script>
        function confirmDelete(form) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

