<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'server/connection.php';
require_once 'server/session.php';
require_once 'server/crud.php';

$session = new Session();

if ($session->isLoggedIn()) {
    $user_id = $_SESSION['user_id'];  // Retrieve user_id from the session

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    function checkAndProcessExpiredBids($conn, $user_id) {
        // Query to check if the user's bid has expired and they are the highest bidder
        $query = "SELECT * FROM pending_bid WHERE bid_deadline <= NOW() AND status != 'won' AND user_id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $expiredBids = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($expiredBids as $bid) {
            // Check if the user's bid was the highest
            if ($bid['high_bid_amount'] >= $bid['high_bid_amount']) {
                // Insert the winning bid into bids_won table
                $insertQuery = "INSERT INTO bids_won (product_id, user_id, bid_amount) 
                                VALUES (:product_id, :user_id, :bid_amount)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bindParam(':product_id', $bid['product_id']);
                $insertStmt->bindParam(':user_id', $bid['user_id']);
                $insertStmt->bindParam(':bid_amount', $bid['high_bid_amount']);
                $insertStmt->execute();

                // Update the status of the bid to 'won' in pending_bid table
                $updateQuery = "UPDATE pending_bid SET status = 'won' WHERE bid_id = :bid_id";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bindParam(':bid_id', $bid['bid_id']);
                $updateStmt->execute();

                // Update the status of the product to 'sold' in products table
                $updateProductQuery = "UPDATE products SET status = 'sold' WHERE product_id = :product_id";
                $updateProductStmt = $conn->prepare($updateProductQuery);
                $updateProductStmt->bindParam(':product_id', $bid['product_id']);
                $updateProductStmt->execute();

                // Return a success message to trigger the SweetAlert
                return [
                    'success' => true,
                    'message' => 'You have won the bid!',
                    'redirect' => 'dashboard.php'
                ];
            }
        }
        return ['success' => false];
    }

    // Call the function to process expired bids
    $result = checkAndProcessExpiredBids($db, $user_id);

    // Fetch winning bids for the logged-in user
    $query = "SELECT bw.*, p.product_name, p.product_image, p.starting_price, p.highest_bid 
              FROM bids_won bw 
              JOIN products p ON bw.product_id = p.product_id 
              WHERE bw.user_id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $winning_bids = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <?php if (isset($result) && $result['success']): ?>
        <script>
            Swal.fire({
                title: 'Congratulations!',
                text: '<?php echo $result['message']; ?>',
                icon: 'success'
            }).then(() => {
                window.location.href = '<?php echo $result['redirect']; ?>';
            });
        </script>
    <?php endif; ?>
</body>
</html>