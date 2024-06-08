<?php
// Define environment variables
putenv("DB_HOST=localhost");
putenv("DB_USERNAME=root");
putenv("DB_PASSWORD=");
putenv("DB_DATABASE=PintarPinjam");

// Database configuration
$type = "mysql";
$servername = getenv('DB_HOST');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_DATABASE');

try {
    $dsn = $type.":host=".$servername.";dbname=".$dbname.";charset=utf8mb4";
    $opt = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    
    $conn = new PDO($dsn, $username, $password, $opt);
} catch (PDOException $err) {
    die("Connection failed: " . $err->getMessage());
}
?>
