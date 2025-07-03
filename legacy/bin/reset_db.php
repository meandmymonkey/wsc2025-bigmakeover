<?php
// Include database connection
require_once(__DIR__ . '/../db_connect.php');

// SQL statements to reset the database
$sql = "-- Drop tables in correct order (child tables first)
DROP TABLE IF EXISTS blog_posts CASCADE;
DROP TABLE IF EXISTS blog_categories CASCADE;
DROP TABLE IF EXISTS users CASCADE;";


// Execute the SQL
$result = pg_query($conn, $sql);

if ($result === false) {
    die("Database reset failed: " . pg_last_error($conn) . "\n");
}

echo "Database reset completed successfully!\n";

// Close the connection
pg_close($conn);
?>
