<?php
include_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Basic validation
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if username exists
        $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {
            $error = "Username already taken!";
        } else {
            // Insert user
            $hash = hash("sha256", $password);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hash);
            if ($stmt->execute()) {
                header("Location: login.php?registered=1");
                exit;
            } else {
                $error = "Error registering user!";
            }
        }
    }
}
?>

<?php include_once 'includes/header.php'; ?>

<h2>Register</h2>
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <label>Confirm Password:</label><br>
    <input type="password" name="confirm_password" required><br><br>
    <button type="submit">Register</button>
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<?php include_once 'includes/footer.php'; ?>
