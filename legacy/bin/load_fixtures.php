<?php
// Include database connection
require_once(__DIR__ . '/../db_connect.php');

// Read the fixtures SQL file
$sql = file_get_contents(__DIR__ . '/../data/fixtures.sql');

if ($sql === false) {
    die("Error reading fixtures.sql file\n");
}

// Execute the SQL
$result = pg_query($conn, $sql);

if ($result === false) {
    die("Loading fixtures failed: " . pg_last_error($conn) . "\n");
}

echo "Fixtures loaded successfully!\n";

// Close the connection
pg_close($conn);
?>
