<?php
// Include database connection
require_once(__DIR__ . '/../db_connect.php');

// Read the SQL file
$sql = file_get_contents(__DIR__ . '/../data/setup.sql');

if ($sql === false) {
    die("Error reading setup.sql file\n");
}

// Execute the SQL
$result = pg_query($conn, $sql);

if ($result === false) {
    die("Database setup failed: " . pg_last_error($conn) . "\n");
}

echo "Database setup completed successfully!\n";

// Close the connection
pg_close($conn);
?>
