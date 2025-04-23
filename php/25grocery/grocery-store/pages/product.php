<?php include_once __DIR__ . '/../includes/header.php'; ?>
<?php include_once __DIR__ . '/../config/db.php'; ?>

<h2>Products</h2>

<?php
$result = $conn->query("SELECT * FROM products");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='margin-bottom: 20px;'>
            <img src='{$row['image']}' width='120' style='display:block;'><br>
            <strong>{$row['name']}</strong> - $ {$row['price']}<br>
            <form method='POST' action='cart.php'>
                <input type='hidden' name='product_id' value='{$row['id']}'>
                <input type='number' name='quantity' value='1' min='1'>
                <input type='submit' name='add_to_cart' value='Add to Cart'>
            </form>
        </div><hr>";
    }
} else {
    echo "<p>No products found.</p>";
}
?>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
