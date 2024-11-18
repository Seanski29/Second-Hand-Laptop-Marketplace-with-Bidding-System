<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
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
                <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="about us.html">About Us</a></li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>


    <!-- START OF MARKET SECTION -->
    <section id="brand" class="container py-5">
        <div class="row">
            <!-- DB connection get products -->
            <?php include('server/get_products.php') ?>
            <?php while($row = $get_products->fetch_assoc()){ ?>
            <!-- Products -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="LAPTOP" src="assets/images/<?php echo $row['product_image'] ?>"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title"><?php echo $row['product_name'] ?></h3>
                        <p class="product-description"><?php echo $row['product_description'] ?></p>
                        <p class="starting-price">Starting Price: $<?php echo $row['starting_price'] ?></p>
                        <p class="highest-bid">Highest Bid: $<?php echo $row['highest_bid'] ?></p>
                        <a href="<?php echo "bid.php?product_id=" . $row['product_id'];?>"><button class="btn btn-primary w-100 mt-auto">Enter Bid</button></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- END OF MARKET SECTION -->

    <!-- START OF FOOTER -->
    <footer class="mt-5 py-5 bg-dark text-white">
        <div id="footer" class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img src="assets/images/Logo.webp" width="100" height="100"/>
                    <p class="pt-3">We are happy that you chose LaptopHaven for your second hand laptop hunting!</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Categories</h5>
                    <ul class="text-uppercase">
                        <li><a href="#">Budget-Friendly</a></li>
                        <li><a href="#">Low-End</a></li>
                        <li><a href="#">Mid-End</a></li>
                        <li><a href="#">High-End</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <h5 class="pb-2">Contact us</h5>
                    <div><h6>Andor</h6><p>123 Lipa City Batangas</p></div>
                    <div><h6>Del Rosario</h6><p>123 Lipa City Batangas</p></div>
                    <div><h6>Romero</h6><p>123 Lipa City Batangas</p></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END OF FOOTER -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
