<?php
require_once 'server/session.php';
$session = new Session();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <?php endif; ?>
                <a class="button-navbar" href="register.php">Register</a>
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- NAVBAR -->

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($session->get('user_name')); ?>!</h2>
        <p>You are logged in as <?php echo htmlspecialchars($session->get('user_email')); ?>.</p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
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
