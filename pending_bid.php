<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Bids</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
require_once 'server/connection.php';
require_once 'server/Session.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user_id = $session->get('user_id'); // Get the logged-in user ID

// Fetch pending bids for the logged-in user
$query = "SELECT pb.bid_id, p.product_id, p.product_name, p.product_image, 
                 pb.high_bid_amount, pb.bid_time, p.bid_deadline 
          FROM pending_bid pb 
          JOIN products p ON pb.product_id = p.product_id 
          WHERE pb.user_id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$pending_bids = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<!-- BID SECTION -->
 <!-- START OF PENDING SECTION -->
 <div text-center>
     <h1 class="text-center mb-4 pt-5">Pending Bids</h1>
     </div>
    <section id="brand" class="container py-5">
    <div class="row">
        <!-- DB connection get products -->
        <?php if (count($pending_bids) > 0): ?>
            <?php foreach ($pending_bids as $row): ?>
        <!-- Products -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4 product-card">
        <div class="card h-100 d-flex flex-column">
                    <img 
                        class="card-img-top product-image" 
                            alt="LAPTOP" 
                                src="assets/images/<?php echo htmlspecialchars($row['product_image']); ?>" 
                            onerror="this.onerror=null; this.src='<?php echo htmlspecialchars($row['product_image']); ?>';"/>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                            <p>Bid Amount: $<?php echo htmlspecialchars($row['high_bid_amount']); ?></p>
                            <p>Bid Time: <?php echo htmlspecialchars($row['bid_time']); ?></p>
                            <p>Bidding Deadline: <?php echo htmlspecialchars($row['bid_deadline']); ?></p>
                            <form method="POST" action="server/delete_bid.php" onsubmit="return confirmDelete(this);">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                            <button type="submit" class="btn btn-danger w-100 mt-2">Delete Bid</button>
                        </form>

                        <script>
                        function confirmDelete(form) {
                            // SweetAlert for better UI
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You are about to delete this bid.",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#d33",
                                cancelButtonColor: "#3085d6",
                                confirmButtonText: "Yes, delete it!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            });
                            return false; // Prevent form from submitting until confirmation is handled
                        }
                        </script>


                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">You have no pending bids.</p>
        <?php endif; ?>
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