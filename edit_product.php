<?php
require_once 'server/connection.php';
require_once 'server/session.php';
require_once 'server/crud.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $product_id = htmlspecialchars(trim($_POST['product_id']));
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    $product_description = htmlspecialchars(trim($_POST['product_description']));
    $starting_price = htmlspecialchars(trim($_POST['starting_price']));
    $bid_deadline = htmlspecialchars(trim($_POST['bid_deadline']));

    if ($user->editProduct($product_id, $product_name, $product_description, $starting_price, $bid_deadline)) {
        echo "
        <script>
            alert('Product updated successfully!');
            window.location.href = 'dashboard.php';  // Redirect to dashboard or another page
        </script>";
    } else {
        echo "<script>alert('Error! Could not update the product.');</script>";
    }
}
?>