<?php
require_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM products limit 20");
$stmt->execute();

$get_products = $stmt->get_result();

?>