<?php
session_start();
include('db_connect.php');

$result = pg_query($conn, "SELECT * FROM blog_posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Quotes</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="header-nav">
        <h1>Movie Quotes</h1>
        <div class="user-nav">
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
                Welcome, <?php echo htmlspecialchars($_SESSION['display_name']); ?> |
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
        <a href="create.php" class="action-link">Create New Post</a>
    <?php endif; ?>

    <div class="posts">
        <?php while($row = pg_fetch_assoc($result)): ?>
            <div class="post">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <div class="date"><?php echo date('F j, Y', strtotime($row['created_at'])); ?></div>
                <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
                <div class="post-actions">
                    <a href="view.php?id=<?php echo $row['id']; ?>">Read More</a>
                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');" class="delete-link">Delete</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
