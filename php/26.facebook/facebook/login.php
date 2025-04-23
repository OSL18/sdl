<?php
// login.php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Optionally set a cookie (valid for 7 days)
            setcookie("user", $user['username'], time() + (7 * 24 * 60 * 60));
            header("Location: home.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <form method="post" class="w-50 mx-auto">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <div class="text-center mt-2">
        Don't have an account? <a href="register.php">Sign up here</a>
      </div>
    </form>
  </div>
</body>
</html>