<?php
require_once 'connection.php';

$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'latest';

// Modify the SQL query 
switch ($sort_option) {
    case 'latest':
        $order_by = 'ORDER BY product_id DESC'; 
        break;
    case 'oldest':
        $order_by = 'ORDER BY product_id ASC'; // Use an existing column for sorting
        break;
    default:
        $order_by = 'ORDER BY product_id DESC'; 
        break;
}

// Fetch products from the database
$query = "SELECT * FROM products $order_by LIMIT 8";
$stmt = $conn->prepare($query);
$stmt->execute();
$get_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $get_products;
?>