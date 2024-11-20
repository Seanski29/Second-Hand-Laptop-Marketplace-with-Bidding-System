<?php
require_once('connection.php');

// Prepare and execute the query
$stmt = $conn->prepare("SELECT * FROM products LIMIT 8");
$stmt->execute();

// Fetch the results
$get_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Output the results as JSON -->
<script>
    var products = <?php echo json_encode($get_products); ?>;
</script>