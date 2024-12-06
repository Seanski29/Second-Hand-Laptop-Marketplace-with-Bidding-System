<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'server/connection.php';
require_once 'server/session.php';
require_once 'server/crud.php';
require_once 'server/win.php';

$session = new Session();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit();
}
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
        if ($bid['high_bid_amount'] >= $bid['bid_amount']) {
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

            // Return a success message to trigger the SweetAlert
            return [
                'success' => true,
                'message' => 'You have won the bid!',
                'redirect' => 'bids_won.php'
            ];
        }
    }
    return ['success' => false];
}
$result = checkAndProcessExpiredBids($conn, $user_id);
if ($result['success']) {
    echo "<script>
        Swal.fire({
            title: 'Congratulations!',
            text: '{$result['message']}',
            icon: 'success'
        }).then(() => {
            window.location.href = '{$result['redirect']}';
        });
    </script>";
    
}
?>