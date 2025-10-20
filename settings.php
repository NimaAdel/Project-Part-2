<?php
// Database credentials for local server
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // As specified, no password for local dev
define('DB_PASSWORD', '');
define('DB_NAME', 'test'); // Using 'jobsdb' for all operations for simplicity

// Establish database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>