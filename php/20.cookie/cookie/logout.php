<?php
session_start();
session_destroy();

// Remove cookie
setcookie('username', '', time() - 3600, '/');

header("Location: index.php");
exit();
?>