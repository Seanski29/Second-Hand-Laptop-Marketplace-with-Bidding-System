<?php
require_once 'server/connection.php'; // Ensure your database connection is included
require_once 'server/crud.php'; // Include your CRUD operations
require_once 'server/session.php'; // Include the Session class file
$session = new Session();

// Check if the search query is set
if (isset($_GET['query'])) {
    $search_query = htmlspecialchars(trim($_GET['query']));

    // Database connection
    $database = new Database();
    $db = $database->getConnection();

    // Prepare the SQL statement
    $query = "SELECT * FROM products WHERE product_name LIKE :search_query OR product_description LIKE :search_query";
    $stmt = $db->prepare($query);
    
    // Use wildcards for searching
    $search_param = "%" . $search_query . "%";
    $stmt->bindParam(':search_query', $search_param);

    // Execute the query
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $results = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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

    <!-- SEARCH RESULTS SECTION -->
    <div class="container my-5">
    <h2>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>
    <div class="row">
        <?php if (!empty($results)): ?>
            
            <?php foreach ($results as $row): ?>
                
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 d-flex flex-column">
                <?php 
            // Check the number of results
            $result_count = count($results);
            $col_class = ($result_count == 1) ? 'col-12' : 'col-lg-3 col-md-6 col-sm-12'; // Full width for 1 result// Use full width if only one result
            ?>
            <img 
                class="card-img-top product-image" 
                alt="LAPTOP" 
                src="assets/images/<?php echo htmlspecialchars($row['product_image']); ?>" 
                onerror="this.onerror=null; this.src='<?php echo htmlspecialchars($row['product_image']); ?>';"/>
                <div class="card-body d-flex flex-column">
                    <h3 class="product-title"><?php echo $row['product_name']; ?></h3>
                    <p class="product-description"><?php echo $row['product_description']; ?></p>
                    <p class="starting-price">Starting Price: $<?php echo $row['starting_price']; ?></p>
                    <p class="highest-bid">Highest Bid: $<?php echo $row['highest_bid']; ?></p>
                    <p class="bid_deadline">Bidding Deadline: <?php echo $row['bid_deadline']; ?></p>
                    <a href="bid.php?product_id=<?php echo urlencode($row['product_id']); ?>">
                        <button class="btn btn-primary w-100 mt-auto">Enter Bid</button></a>
                </div>
            </div>
        </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No products found matching your search.</p>
            </div>
        <?php endif; ?>
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