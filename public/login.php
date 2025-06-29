<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('db_connect.php');
    
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Using MD5 as per legacy requirements
    
    $result = pg_query_params($conn, 
        "SELECT * FROM users WHERE email = $1 AND password = $2 AND enabled = TRUE",
        array($email, $password)
    );
    
    if ($row = pg_fetch_assoc($result)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['display_name'] = $row['display_name'];
        $_SESSION['is_logged_in'] = true;
        
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Movie Quote Blog</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="header-nav">
        <h1>Movie Quote Blog</h1>
    </div>

    <div class="form-container">
        <h2>Login</h2>
        
        <?php if (isset($error)): ?>
            <div style="color: #e74c3c; margin-bottom: 1em;"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="post" action="login.php">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <div class="button-group">
                <input type="submit" value="Login" class="button button-primary">
                <a href="index.php" class="button button-secondary">Back to Blog</a>
            </div>
        </form>
    </div>
</body>
</html>
