<?php
include('auth_check.php');
include('db_connect.php');

$id = (int)$_GET['id'];
if (!$id) {
    header("Location: index.php");
    exit;
}

$result = pg_query_params($conn, "DELETE FROM blog_posts WHERE id = $1", array($id));

if ($result === false) {
    die('Error deleting post: ' . pg_last_error($conn));
}

// Check if any rows were actually deleted
if (pg_affected_rows($result) > 0) {
    header("Location: index.php");
    exit;
} else {
    die('No post found or you don\'t have permission to delete it.');
}
?>