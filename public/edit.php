<?php
include('auth_check.php');
include('db_connect.php');

$id = (int)$_GET['id'];
if (!$id) {
    header("Location: index.php");
    exit;
}

// Get categories for the dropdown
$categories_query = "SELECT id, name FROM blog_categories ORDER BY name";
$categories_result = pg_query($conn, $categories_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = (int)$_POST['category_id'];
    
    $query = "UPDATE blog_posts SET title = $1, content = $2, category_id = $3 WHERE id = $4";
    $result = pg_query_params($conn, $query, array($title, $content, $category_id, $id));
    
    if ($result) {
        header("Location: index.php");
        exit;
    }
}

$result = pg_query_params($conn, "SELECT * FROM blog_posts WHERE id = $1", array($id));
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
    <title>Edit Post - Movie Quote Blog</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="header-nav">
        <h1>Edit Post</h1>
        <div class="user-nav">
            Welcome, <?php echo htmlspecialchars($_SESSION['display_name']); ?> | 
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="form-container">
        <form method="post">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>

            <div class="form-group">
                <label>Category:</label>
                <select name="category_id" required>
                    <?php while ($category = pg_fetch_assoc($categories_result)): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $post['category_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Content:</label>
                <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>

            <div class="button-group">
                <input type="submit" value="Update Post" class="button button-primary">
                <a href="index.php" class="button button-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
