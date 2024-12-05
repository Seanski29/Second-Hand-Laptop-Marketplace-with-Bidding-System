<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php

require_once 'server/crud.php';
require_once 'server/database.php';
require_once 'server/Session.php';

$session = new Session();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];  // Retrieve user_id from the session

// Instantiate the Database class
$database = new Database();
$conn = $database->getConnection();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $product_name = htmlspecialchars(trim($_POST['productName']));
    $product_description = htmlspecialchars(trim($_POST['productDescription']));
    $starting_price = floatval($_POST['startingPrice']);
    $bid_deadline = htmlspecialchars(trim($_POST['biddingDeadline']));

    // Handle file upload
    $target_dir = "assets/images/";  
    $file_name = uniqid() . "_" . basename($_FILES["productImage"]["name"]);
    $target_file = $file_name;
    $target_files = $target_dir . $file_name;

    if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] === UPLOAD_ERR_OK) {
        // Check if the upload directory is writable
        if (is_writable($target_dir)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_files)) {
                // Insert product data into the database, including user_id
                $sql = "INSERT INTO products (user_id, product_name, product_description, product_image, starting_price, bid_deadline) 
                        VALUES (?, ?, ?, ?, ?, ?)";

                if ($stmt = $conn->prepare($sql)) {
                    // Bind parameters and execute the query
                    $stmt->bindParam(1, $user_id);  // Bind user_id
                    $stmt->bindParam(2, $product_name);
                    $stmt->bindParam(3, $product_description);
                    $stmt->bindParam(4, $target_file);
                    $stmt->bindParam(5, $starting_price);
                    $stmt->bindParam(6, $bid_deadline);

                    if ($stmt->execute()) {
                        echo "
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Your product is now listed in the marketplace.',
                                text: 'Please wait for the highest bidder',
                                showConfirmButton: false,
                                timer: 7000
                            }).then(function() {
                                window.location.href = 'market.php';  // Redirect after SweetAlert closes
                            });
                        </script>";
                    } else {
                        echo "Error: " . $stmt->errorInfo()[2];
                    }
                    $stmt = null;
                } else {
                    echo"
                    <script>
                    Swal.fire('Error preparing the SQL statement.');
                    </script>";
                }
            } else {
                echo"
                    <script>
                    Swal.fire('Error Uploading Image.');
                    </script>";
            }
        } else {
            echo"
                    <script>
                    Swal.fire('Error: Upload Directory is not writable');
                    </script>";
        }
    } else {
        echo "<script>
                    Swal.fire('No file uploaded or there was an error uploading the file.');
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
