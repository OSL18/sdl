<?php
session_start();
include_once 'config/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['username'];

// Get user ID
$userQuery = $conn->prepare("SELECT id FROM users WHERE username = ?");
$userQuery->bind_param("s", $user);
$userQuery->execute();
$userResult = $userQuery->get_result();
$userData = $userResult->fetch_assoc();
$userId = $userData['id'];

// Add book to cart
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id'];
    $quantity = $_POST['quantity'];

    // Check if already in cart
    $check = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND book_id = ?");
    $check->bind_param("ii", $userId, $bookId);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Update quantity
        $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND book_id = ?");
        $update->bind_param("iii", $quantity, $userId, $bookId);
        $update->execute();
    } else {
        // Insert new
        $stmt = $conn->prepare("INSERT INTO cart (user_id, book_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $userId, $bookId, $quantity);
        $stmt->execute();
    }

    header("Location: checkout.php");
    exit;
}
?>
