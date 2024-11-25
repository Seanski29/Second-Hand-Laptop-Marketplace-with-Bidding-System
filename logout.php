<?php
require_once 'server/session.php';
$session = new Session();
$session->logout();
header("Location: login.php");
exit;
?>