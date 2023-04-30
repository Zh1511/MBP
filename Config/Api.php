<?php

//connection
define('DB_HOST', 'mbp-db.crr4ck204eku.us-east-1.rds.amazonaws.com');
define('DB_USER', 'admin');
define('DB_PASS', 'mondayblues');
define('DB_NAME', 'MBP');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

?>
