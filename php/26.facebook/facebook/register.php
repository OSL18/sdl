<?php

// register.php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
    } else {
        $error = "Registration Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center">Sign Up</h2>
    <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <form method="post" action="" class="w-50 mx-auto">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password (min. 6 characters)</label>
        <input type="password" name="password" class="form-control" required minlength="6">
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
      <div class="text-center mt-2">
        Already have an account? <a href="login.php">Login here</a>
      </div>
    </form>
  </div>
</body>
</html>