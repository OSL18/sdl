<?php
// profile.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Your Profile</h2>
    <div class="card p-3">
      <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
      <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
      <p><strong>Member Since:</strong> <?php echo $user['created_at']; ?></p>
      <a href="home.php" class="btn btn-primary">Back to Feed</a>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</body>
</html>