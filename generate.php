<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'database');
$sql_file = 'database.sql';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
if ($conn->connect_error) {
    die("Server connection failed: " . $conn->connect_error);
}
$create_db_sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if (!$conn->query($create_db_sql)) {
    die("Error creating database: " . $conn->error);
}
$conn->select_db(DB_NAME);
if ($conn->error) {
    die("Error selecting database '" . DB_NAME . "': " . $conn->error);
}
$sql_commands = file_get_contents($sql_file);
if ($sql_commands === false) {
    die("Error: Could not read SQL file '$sql_file'.");
}
if (!$conn->multi_query($sql_commands)) {
    die("Error executing SQL commands: " . $conn->error);
}
do {
    if ($result = $conn->store_result()) {
        $result->free();
    }
} while ($conn->more_results() && $conn->next_result());
if ($conn->error) {
    die("Error after multi_query execution: " . $conn->error);
}
$conn->close();
?>