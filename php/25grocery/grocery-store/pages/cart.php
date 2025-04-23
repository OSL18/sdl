<?php include '../includes/header.php'; include '../config/db.php'; ?>

<?php
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO cart (product_id, quantity) VALUES (?, ?)");
    $stmt->bind_param("ii", $product_id, $quantity);
    $stmt->execute();
    echo "<p>Product added to cart!</p>";
}

$result = $conn->query("SELECT p.name, c.quantity, p.price 
                        FROM cart c JOIN products p ON c.product_id = p.id");

echo "<h2>Your Cart</h2>";
while($row = $result->fetch_assoc()) {
    echo "{$row['name']} x {$row['quantity']} = $" . ($row['price'] * $row['quantity']) . "<br>";
}
$conn->close();
?>

<?php include '../includes/footer.php'; ?>
