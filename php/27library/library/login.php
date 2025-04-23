<?php
session_start();
include_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username' AND password=SHA2('$password', 256)";
    $result = $conn->query($sql);
    
    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid login!";
    }
}
?>

<?php include_once 'includes/header.php'; ?>

<h2>Login</h2>
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<?php include_once 'includes/footer.php'; ?>
