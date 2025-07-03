<?php
//session_start();
include('db_connect.php');

$id = $symfonyRequest->query->getInt('id');
if (!$id) {
    header("Location: index.php");
    exit;
}

$result = pg_query_params($conn, "SELECT p.*, c.name as category_name, u.display_name as author FROM blog_posts p LEFT JOIN blog_categories c ON p.category_id = c.id LEFT JOIN users u ON p.user_id = u.id WHERE p.id = $1", array($id));
$post = pg_fetch_assoc($result);

if (!$post) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Movie Quote Blog</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="header-nav">
        <h1>Movie Quote Blog</h1>
        <div class="user-nav">
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
                Welcome, <?php echo htmlspecialchars($_SESSION['display_name']); ?> |
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="post">
        <div class="post-header">
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <div class="post-meta">
                <div class="date"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></div>
                <div class="category"><?php echo htmlspecialchars($post['category_name'] ?: 'Uncategorized'); ?></div>
                <div class="author"><?php echo htmlspecialchars($post['author'] ?: 'Anonymous'); ?></div>
            </div>
        </div>

        <div class="post-content">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>

        <div class="post-actions">
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
                <a href="edit.php?id=<?php echo $post['id']; ?>" class="button button-primary">Edit</a>
                <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?');" class="button button-secondary delete-link">Delete</a>
            <?php endif; ?>
            <a href="index.php" class="button button-secondary">Back to Posts</a>
        </div>
    </div>
</body>
</html>
