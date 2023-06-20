<?php
require_once '../../../App/config.php';

try {
    $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8", DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
} catch(PDOException $e) {
    throw new Exception('Database connection failed: '.$e->getMessage());
}
?>
