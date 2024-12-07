<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
session_start();
require_once 'server/connection.php';
require_once 'server/crud.php';
require_once 'server/session.php';

$session = new Session();

// Check if the user is already logged in
if ($session->isLoggedIn()) {
    header("Location: index.php"); // Redirect to home page if already logged in
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->user_email = htmlspecialchars(trim($_POST['email']));
    $user_password = htmlspecialchars(trim($_POST['password'])); // Store the password in a local variable

    if ($user->login($user_password)) { // Pass the password to the login method
        
        // Retrieve user details including user_id
        $query = "SELECT user_id, user_name FROM users WHERE user_email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $user->user_email);
        $stmt->execute();
        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userDetails) {
            // Set session variables
            $session->set('user_id', $userDetails['user_id']);
            $session->set('user_email', $user->user_email);
            $session->set('user_name', $userDetails['user_name']);
            $session->set('logged_in', true);
            
            echo "
            <script>
                Swal.fire({
                    title: 'Welcome to LaptopHaven',
                    text: 'Login Successful',
                    icon: 'success'
                }).then(function() {
                    window.location.href = 'market.php';  // Redirect after SweetAlert closes
                });
            </script>";
        } else {
            echo "
            <script>
                Swal.fire({
                    title: 'Oops!',
                    text: 'User details not found. Please try again.',
                    icon: 'error'
                }).then(function() {
                    window.location.href = 'login.php';  // Redirect after SweetAlert closes
                });
            </script>";
        }
    } else { // If login failed
        echo "
        <script>
            Swal.fire({
                title: 'Oops!',
                text: 'Invalid login credentials. Please try again.',
                icon: 'error'
            }).then(function() {
                window.location.href = 'login.php';  // Redirect after SweetAlert closes
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
                <button class="btn btn-outline-success" type="submit" >Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- END OF NAVBAR -->

<!-- LOGIN FORM -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Log IN</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="login.php">
            <div class="mb-3">
                <label for="login-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="register-password" class="form-label">Password</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <button id="login" type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
            <div class="mb-3">
                <a href="register.php" class="btn btn-link">Don't have an account? Register!</a>
            </div>
        </form>
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