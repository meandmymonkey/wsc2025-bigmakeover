<?php
include('auth_check.php');
include('db_connect.php');

// Get categories for the dropdown
$categories_query = "SELECT id, name FROM blog_categories ORDER BY name";
$categories_result = pg_query($conn, $categories_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = (int)$_POST['category_id'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO blog_posts (title, content, category_id, user_id, created_at) VALUES ($1, $2, $3, $4, NOW())";
    $result = pg_query_params($conn, $query, array($title, $content, $category_id, $user_id));

    if ($result) {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post - Movie Quote Blog</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <div class="header-nav">
        <h1>Create New Post</h1>
        <div class="user-nav">
            Welcome, <?php echo htmlspecialchars($_SESSION['display_name']); ?> |
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="form-container">
        <form method="post" action="create.php">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>Category:</label>
                <select name="category_id" required>
                    <option value="">Select a category</option>
                    <?php while ($category = pg_fetch_assoc($categories_result)): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Content:</label>
                <textarea name="content" required></textarea>
            </div>

            <div class="button-group">
                <input type="submit" value="Create Post" class="button button-primary">
                <a href="index.php" class="button button-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
