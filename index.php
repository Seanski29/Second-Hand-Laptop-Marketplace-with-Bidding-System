<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!----------------------------- START OF NAVBAR ----------------------------->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="assets/images/Logo.webp" width="45" height="55" />
            <a class="navbar-brand" href="#">LaptopHaven</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#brandings">Brands</a></li>
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
    <!----------------------------- END OF NAVBAR ------------------------------>

    <!----------------------------- START OF HOME TEXT ----------------------------->
    <section id="home">
        <div class="container text-center">
            <h5>WELCOME TO LAPTOPHAVEN</h5>
            <h1>Find your Second Hand Choices Here</h1>
            <p>We offer the best prices and auctions</p>
            <a class="nav-link" href="market.php">
                <button>Find Now</button>
            </a>
        </div>
    </section>
    <!----------------------------- END OF HOME TEXT ------------------------------>

    <!----------------------------- START OF BRANDS SECTION ----------------------------->
    <section id="brands">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/Asus.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/MSI.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/Lenovo.jpg" />
            <img id="brandings" class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/Gigabyte.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/Dell.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/HP.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/Acer.jpg" />
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/Razer.png" />
        </div>
    </section>
    <!----------------------------- END OF BRANDS SECTION ------------------------------>

    <!----------------------------- START OF FOOTER ----------------------------->
    <footer class="mt-5 py-5" style="background-color: gray; padding: 30px 0;">
        <div id="footer" class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img src="assets/images/Logo.webp" width="70" height="100" margin="center" />
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
                    <h5 class="pb-2">Contact Us</h5>
                    <div>
                        <h6 class="text-uppercase">Andor</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                    <div>
                        <h6 class="text-uppercase">Del Rosario</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                    <div>
                        <h6 class="text-uppercase">Romero</h6>
                        <p>123 Lipa City Batangas</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!----------------------------- END OF FOOTER ------------------------------>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
