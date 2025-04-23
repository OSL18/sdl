<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;

        // Set cookie if "Remember Me" is checked
        if (isset($_POST['remember'])) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
        }

        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: index.php?error=Invalid username or password.");
        exit();
    }
}
?>