<?php
// home.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Process new post submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['content'])) {
    $content = mysqli_real_escape_string($conn, trim($_POST['content']));
    $user_id = $_SESSION['user_id'];
    $image = '';

    // Handle image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = $target_file;
    }

    $sql = "INSERT INTO posts (user_id, content, image) VALUES ($user_id, '$content', '$image')";
    mysqli_query($conn, $sql);
}

// Fetch posts (latest first)
$result = mysqli_query($conn, "SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home - News Feed</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .post {
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      background: #fff;
    }
    .post img {
      max-width: 100%;
      height: auto;
      margin-top: 10px;
      border-radius: 5px;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2>News Feed</h2>
      <div>
        <span>Welcome, <?php echo $_SESSION['username']; ?></span>
        <a href="profile.php" class="btn btn-sm btn-secondary">Profile</a>
        <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
      </div>
    </div>
    <!-- Post Form -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <textarea name="content" class="form-control" placeholder="What's on your mind?" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <input type="file" name="image" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Post</button>
        </form>
      </div>
    </div>
    <!-- Posts Listing -->
    <?php while($post = mysqli_fetch_assoc($result)) { ?>
      <div class="post">
        <p><strong><?php echo $post['username']; ?></strong> <small><?php echo $post['created_at']; ?></small></p>
        <p><?php echo $post['content']; ?></p>
        <?php if ($post['image'] != '') { ?>
          <img src="<?php echo $post['image']; ?>" alt="Post Image">
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</body>
</html>