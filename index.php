<?php

// Replace with your RDS endpoint and credentials
$endpoint = 'mbp-db.crr4ck204eku.us-east-1.rds.amazonaws.com';
$username = 'admin';
$password = 'mondayblues';
$dbname = 'MBP';

// Attempt to connect to the database
try {
    $dbh = new PDO("mysql:host={$endpoint};dbname={$dbname}", $username, $password);
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
