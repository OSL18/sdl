<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Check for cookie
if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <input type="checkbox" name="remember" value="1"> Remember Me<br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>