<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Products</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>


<?php
require_once 'connection.php';
require_once 'session.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    header("Location: ../login.php");
    exit();
}

// Check if product_id is set in POST
if (isset($_POST['product_id'])) {
    $product_id = htmlspecialchars(trim($_POST['product_id']));
    $user_id = $session->get('user_id');

    try {
        // Delete the bid from pending_bid table
        $deleteQuery = "DELETE FROM pending_bid WHERE product_id = :product_id AND user_id = :user_id";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Update the products table
            $updateProductQuery = "UPDATE products 
                SET highest_bid = IFNULL((SELECT MAX(high_bid_amount) FROM pending_bid WHERE product_id = :product_id), starting_price),
                    highest_bidder_id = (SELECT user_id FROM pending_bid WHERE product_id = :product_id ORDER BY high_bid_amount DESC LIMIT 1)
                WHERE product_id = :product_id";
            $updateStmt = $conn->prepare($updateProductQuery);
            $updateStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $updateStmt->execute();

            // Redirect with success message
            echo "<script>
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your bid has been successfully deleted.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '../pending_bid.php';
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete the bid. Please try again.',
                        icon: 'error'
                    }).then(() => {
                        window.location.href = '../pending_bid.php';
                    });
                </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Database error: " . $e->getMessage() . "',
                    icon: 'error'
                }).then(() => {
                    window.location.href = '../pending_bid.php';
                });
            </script>";
    }
} else {
    echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Invalid request.',
                icon: 'error'
            }).then(() => {
                window.location.href = '../pending_bid.php';
            });
        </script>";
}
?>
