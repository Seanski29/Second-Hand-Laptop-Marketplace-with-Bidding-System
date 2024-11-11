<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

    <!-- START OF NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="assets/images/Logo.webp" width="45" height="55" />
            <a class="navbar-brand" href="#">LaptopHaven</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Brands</a></li>
                    <li class="nav-item"><a class="nav-link" href="market.php">Market</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- END OF NAVBAR -->

    <!-- START OF MARKET SECTION -->
    <section id="brand" class="container py-5">
        <div class="row">

            <!-- Product Card Template -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="ASUS ROG STRIX" src="assets/images/ASUS ROG STRIX.jpg"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">ASUS ROG STRIX</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $50</p>
                        <p class="highest-bid">Highest Bid: $75</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

            <!-- Repeat Product Card for Each Item -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="ASUS ROG ZEPHYRUS" src="assets/images/ASUS ROG ZEPHYRUS.jfif"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">ASUS ROG ZEPHYRUS</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $80</p>
                        <p class="highest-bid">Highest Bid: $120</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="GIGABYTE AORUS 15 2023" src="assets/images/GIGABYTE AORUS 15 2023.jfif"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">GIGABYTE AORUS 15 2023</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $80</p>
                        <p class="highest-bid">Highest Bid: $120</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="GIGABYTE G6 2023" src="assets/images/GIGABYTE G6 2023.jpg"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">GIGABYTE G6 2023</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $80</p>
                        <p class="highest-bid">Highest Bid: $120</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="GIGABYTE G6 2023" src="assets/images/GIGABYTE G6 2023.jpg"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">GIGABYTE G6 2023</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $80</p>
                        <p class="highest-bid">Highest Bid: $120</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="GIGABYTE G6 2023" src="assets/images/LENOVO LEGION PRO 5i GEN 9.jpg"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">LENOVO LEGION PRO 5i GEN 9</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $80</p>
                        <p class="highest-bid">Highest Bid: $120</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="LENOVO ThinkPad E14 G5" src="assets/images/LENOVO ThinkPad E14 G5.jfif"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">LENOVO ThinkPad E14 G5</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $80</p>
                        <p class="highest-bid">Highest Bid: $120</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                    <img class="card-img-top product-image" alt="MSI STEALTH A16 AI+" src="assets/images/MSI STEALTH A16 AI+.jpg"/>
                    <div class="card-body d-flex flex-column">
                        <h3 class="product-title">MSI STEALTH A16 AI+</h3>
                        <p class="product-description">This product is in excellent condition.</p>
                        <p class="starting-price">Starting Price: $80</p>
                        <p class="highest-bid">Highest Bid: $120</p>
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- END OF MARKET SECTION -->

    <!-- START OF FOOTER -->
    <footer class="mt-5 py-5 bg-gray">
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
