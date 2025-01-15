<?php

require_once (__DIR__ . '/../../includes/header.php');
require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../config/global.php');

if ($_GET) {
    $stm = $pdo->prepare("DELETE FROM product WHERE id = ?");
    var_dump($stm);
    $stm->bindValue(1,$_GET['id']);
    $stm->execute();
    // redirection  
    header("location: index.php");  
}

require_once (__DIR__ . '/../../includes/footer.php');