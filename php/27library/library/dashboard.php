<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<?php include_once 'includes/header.php'; ?>

<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<p><a href="logout.php">Logout</a></p>

<?php include_once 'includes/footer.php'; ?>
