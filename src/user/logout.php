<?php 
require_once (__DIR__ . '/../../config/global.php');
session_start();
session_destroy();
header("Location:".BASE_URL."index.php");
exit();