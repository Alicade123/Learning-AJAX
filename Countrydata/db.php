<?php
// Database Configuration
$host = 'localhost';
$dbname = 'e_commerce';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    //echo "Database connection successful."; // You can uncomment this for debugging
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
