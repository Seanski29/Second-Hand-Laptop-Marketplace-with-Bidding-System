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
    <title>About Us</title>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
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


    <div class="about-page">
        <div class="learnmore">
            <div class="aboutlogo">

            <img src="assets/images/Logo.webp?v=2 img-center" alt="LaptopHaven Logo" width="300" height="300">
            </div>
            
            <h2>What are we?</h2>
            <p class="about-text">Welcome to LaptopHaven, the premier online marketplace for second-hand laptops. Our platform is designed to connect buyers and sellers in a seamless, secure, and transparent environment. Looking for a budget-friendly laptop? We've got you covered!</p>
            <br>
            <h2>Our Mission</h2>
            <p class="mission-text">At LaptopHaven, our mission is to provide a trusted, user-friendly platform for buying and selling second-hand laptops, empowering customers with affordable, high-quality technology options. We aim to create a transparent, competitive marketplace with our innovative bidding system, ensuring both buyers and sellers enjoy a seamless, secure experience. Through our commitment to sustainability and customer satisfaction, we strive to contribute to a smarter, more sustainable digital future.</p>
    
            <h1 class="team">Our Team</h1>
            <h5 class="happen">Meet the individuals who make it all happen:</h5>
            <div class="contributors">
                <div class="contributors-container">
                    <img src="assets/images/Andor.png" alt="Andor Cedrick S.">
                    <h3>Andor, Cedrick S.</h3>
                    <hr class="underline">
                    <h4>Front-End Developer</h4>
                    <ul>
                        <li>Designed the overall layout of the website, ensuring an intuitive and user-friendly interface.</li>
                        <li>Organized content sections, navigation, and footers for easy accessibility.</li>
                        <li>Ensured the design is lightweight and doesn’t slow down page loading.</li>
                    </ul>
                </div>
    
                <div class="contributors-container">
                    <img src="assets/images/sean.jpg" alt="Del Rosario, Sean Martin L.">
                    <h3>Del Rosario, Sean Martin L.</h3>
                    <hr class="underline">
                    <h4>Team Leader</h4>
                    <ul>
                        <li>Led the development of LaptopHaven, a second-hand laptop marketplace with a bidding system.</li>
                        <li>Oversaw the project lifecycle, ensuring features met requirements.</li>
                        <li>Collaborated with the team to integrate components for a seamless user experience.</li>
                    </ul>
                </div>
                <div class="contributors-container">
                    <img src="assets/images/miguel.png" alt="Romero, Miguel C.">
                    <h3>Romero, Miguel C.</h3>
                    <hr class="underline">
                    <h4>Backend Developer</h4>
                    <ul>
                        <li>Developed and maintained server-side logic for LaptopHaven, ensuring efficient data processing.</li>
                        <li>Collaborated with the front-end team for smooth backend integration.</li>
                        <li>Troubleshot and resolved backend issues to ensure platform stability and responsiveness.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    


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