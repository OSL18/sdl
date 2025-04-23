<?php
session_start();
include_once 'config/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Get user ID
$userQuery = $conn->prepare("SELECT id FROM users WHERE username = ?");
$userQuery->bind_param("s", $username);
$userQuery->execute();
$userResult = $userQuery->get_result();
$user = $userResult->fetch_assoc();
$userId = $user['id'];

$cartQuery = "
    SELECT books.title, books.author, books.price, books.image, cart.quantity
    FROM cart
    JOIN books ON cart.book_id = books.id
    WHERE cart.user_id = ?
";
$stmt = $conn->prepare($cartQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$cartItems = $stmt->get_result();

$total = 0;
?>

<?php include_once 'includes/header.php'; ?>

<h2>Your Cart</h2>

<?php if ($cartItems->num_rows > 0): ?>
    <div class="book-grid">
    <?php while ($row = $cartItems->fetch_assoc()): 
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
    ?>
        <div class="book-card">
            <img src="<?= $row['image'] ?>" alt="Book">
            <h3><?= $row['title'] ?></h3>
            <p><strong>Author:</strong> <?= $row['author'] ?></p>
            <p><strong>Quantity:</strong> <?= $row['quantity'] ?></p>
            <p><strong>Subtotal:</strong> $<?= number_format($subtotal, 2) ?></p>
        </div>
    <?php endwhile; ?>
    </div>
    <h3>Total: $<?= number_format($total, 2) ?></h3>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<?php include_once 'includes/footer.php'; ?>
