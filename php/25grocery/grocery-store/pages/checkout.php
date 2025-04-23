<?php include '../includes/header.php'; include '../config/db.php'; ?>

<h2>Checkout</h2>

<?php
$result = $conn->query("SELECT p.name, c.quantity, p.price 
                        FROM cart c JOIN products p ON c.product_id = p.id");

$total = 0;
echo "<ul>";
while($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    echo "<li>{$row['name']} x {$row['quantity']} = $".$subtotal."</li>";
    $total += $subtotal;
}
echo "</ul>";

echo "<h3>Total: $".$total."</h3>";

if (isset($_POST['checkout'])) {
    $conn->query("DELETE FROM cart");
    echo "<p><strong>Thank you for your purchase! Your order has been placed.</strong></p>";
}
?>

<form method="POST">
    <input type="submit" name="checkout" value="Confirm Checkout">
</form>

<?php include '../includes/footer.php'; ?>
