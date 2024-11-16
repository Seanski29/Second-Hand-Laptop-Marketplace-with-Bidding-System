<?php
require_once('server/connection.php');
if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products where product_id = ? limit 1");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    
    $product = $stmt->get_result();
} 
//If Wala nahanap
else {
    header('Location: market.php');
}   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/alert.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <img src="assets/images/Logo.webp" width="45" height="55" alt="Logo">
        <a class="navbar-brand" href="#">LaptopHaven</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#brandings">Brands</a></li>
                <li class="nav-item"><a class="nav-link" href="market.php">Market</a></li>
                <li class="nav-item"><a class="nav-link" href="#sell.html">Sell</a></li>
                <li class="nav-item"><a class="nav-link" href="about us.html">About us</a></li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<!-- BID SECTION -->
<section class="container my-5 py-5">
    <h2 class="font-weight-bold">Bidding Section</h2>

    <table class="table mt-5">
        <thead>
            <tr>
                <th>Chosen Product</th>
                <th>Highest Bid</th>
                <th>Your Bid</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <?php while ($row = $product->fetch_assoc()){ ?>
                        <img src="assets/images/<?php echo $row['product_image'];?>" class="img-thumbnail me-3" alt="ASUS ROG STRIX" style="width: 100px;">
                        <div>
                            <p> <?php echo $row['product_name'];?></p>
                            <p> <?php echo $row['product_description'];?></p>
                            <small>USD <?php echo $row['starting_price'];?></small>
                            <br>
                            
                        </div>
                    </div>
                </td>
                <td><span>USD</span> <span class="product-price"><?php echo $row['highest_bid'];?></span></td>
                <td>
                    <input type="number" class="form-control" value="<?php echo $row['starting_price'];?>">
                    <button class="btn btn-primary mt-2" onclick="bidinput()">Enter Bid</button>
                </td>
            </tr>
        </tbody>
         <?php } ?>
    </table>
</section>

<!-- FOOTER -->
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
                        <h6>Andor</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                    <div>
                        <h6>Del Rosario</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                    <div>
                        <h6>Romero</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
