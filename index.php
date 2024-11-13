<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - LaptopHaven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#brandings">Brands</a></li>
                <li class="nav-item"><a class="nav-link" href="market.php">Market</a></li>
                <li class="nav-item"><a class="nav-link" href="#sell.html">Sell</a></li>
                <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

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
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Asus.jpg" alt="Asus">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/MSI.jpg" alt="MSI">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img class="img-fluid" src="assets/images/Lenovo.jpg" alt="Lenovo">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img id="brandings" class="img-fluid" src="assets/images/Gigabyte.jpg" alt="Gigabyte">
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
