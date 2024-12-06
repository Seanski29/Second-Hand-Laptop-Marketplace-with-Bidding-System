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
require_once 'server/crud.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

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
                
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4 product-card">
            <div class="card h-100 d-flex flex-column">
                <img class="card-img-top product-image" alt="LAPTOP" src="assets/images/<?php echo $product['product_image']; ?>"/>
                <div class="card-body d-flex flex-column">
                    <h3 class="product-title"><?php echo $product['product_name']; ?></h3>
                    <p class="product-description"><?php echo $product['product_description']; ?></p>
                    <p class="starting-price">Starting Price: $<?php echo $product['starting_price']; ?></p>
                    <p class="highest-bid">Highest Bid: $<?php echo $product['highest_bid']; ?></p>
                    <button type="button" class="btn btn-warning w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['product_id']; ?>">Edit</button>
                    <form method="POST" action="server/delete_product.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <button type="submit" class="btn btn-danger w-100 mt-auto">Delete</button>
                    </form>
                </div>
            </div>
        </div>

                <!-- Edit Product Modal -->
                <div class="modal fade" id="editProductModal<?php echo $product['product_id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="edit_product.php">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <div class="mb-3">
                                        <label for="product_name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_description" class="form-label">Product Description</label>
                                        <textarea class="form-control" id="product_description" name="product_description" required><?php echo $product['product_description']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="starting_price" class="form-label">Starting Price</label>
                                        <input type="number" class="form-control" id="starting_price" name="starting_price" value="<?php echo $product['starting_price']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bid_deadline" class="form-label">Bid Deadline</label>
                                        <input type="datetime-local" class="form-control" id="bid_deadline" name="bid_deadline" value="<?php echo date('Y-m-d\TH:i', strtotime($product['bid_deadline'])); ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
