<?php
require_once 'server/connection.php';
require_once 'server/session.php';

$session = new Session();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - LaptopHaven</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <script src="assets/js/alert.js"></script>
</head>
<body>

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
                    <a class="button-navbar" href="dashboard.php">Logout</a>
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


    <!-- HOME TEXT SECTION -->
    <section id="home" class="text-center py-5">
        <div class="container">
            <h5>WELCOME TO LAPTOPHAVEN</h5>
            <h1>Find Your Second-Hand Choices Here</h1>
            <p>We offer the best prices and auctions</p>
            <a href="market.php">
                <button class="btn btn-primary">Find Now</button>
            </a>
        </div>
    </section>

    <!-- BRANDS SECTION -->
    <section id="brands" class="py-5">
        <div class="container">
            <div class="row g-3">
                <div id="brandings" class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Asus.jpg" alt="Asus">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/MSI.jpg" alt="MSI">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Lenovo.jpg" alt="Lenovo">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Gigabyte.jpg" alt="Gigabyte">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Dell.jpg" alt="Dell">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/HP.jpg" alt="HP">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Acer.jpg" alt="Acer">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Razer.png" alt="Razer">
                </div>
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