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

    if ($user->deleteProduct($product_id)) {
        echo "
        <script>
            alert('Product deleted successfully!');
            window.location.href = 'dashboard.php';  // Redirect to dashboard or another page
        </script>";
    } else {
        echo "<script>alert('Error! Could not delete the product.');</script>";
    }
}
?>