<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <script src="assets/js/alert.js"></script>
</head>
<body>

<?php

require_once 'connection.php';
require_once 'session.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Unauthorized!',
            text: 'You must be logged in to delete products.',
        }).then(() => {
            window.location.href = 'login.php';
        });
    </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $user_id = $_SESSION['user_id']; // Get  user ID

    $database = new Database();
    $db = $database->getConnection();

    // if may nag aari na ng product checker
    $checkQuery = "SELECT product_id FROM products WHERE product_id = :product_id AND user_id = :user_id";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $checkStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        // if Product found, delete it
        $deleteQuery = "DELETE FROM products WHERE product_id = :product_id";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($deleteStmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'Success!',
                    title: 'Deletion Successful',
                    text: 'Your Laptop has been removed from the Marketplace',
                }).then(() => {
                    window.location.href = '../dashboard.php'; // Redirect to dashboard after deletion
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Could not delete the product. Please try again.',
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Unauthorized!',
                text: 'You are not authorized to delete this product.',
            });
        </script>";
    }
}



?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>