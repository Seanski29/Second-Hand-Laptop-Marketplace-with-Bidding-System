<?php
require_once('connection.php');


$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();


$get_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<script>
    var products = <?php echo json_encode($get_products); ?>;
</script>