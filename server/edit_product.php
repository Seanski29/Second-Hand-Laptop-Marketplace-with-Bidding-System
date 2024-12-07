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
</body>
</html>



<?php
require_once 'connection.php';
require_once 'session.php';
require_once 'crud.php';

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
            Swal.fire({
                title: 'Success!',
                text: 'Product updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../dashboard.php';
                }
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Error! Could not update the product.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>