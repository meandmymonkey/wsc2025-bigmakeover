<?php
$dbhost = 'database';
$dbname = 'app';
$dbuser = 'app';
$dbpass = 'app';

$conn = \pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass");
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
