<?php include_once 'includes/header.php'; ?>
<?php include_once 'config/db.php'; ?>

<h2>Books Catalog</h2>

<?php
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='book' style='display: inline-block; margin-right: 50px;'>
            <img src='{$row['image']}' alt='Book Image' width='150'>
            <h3>{$row['title']}</h3>
            <p><strong>Author:</strong> {$row['author']}</p>
            <p><strong>Genre:</strong> {$row['genre']}</p>
            <p><strong>Price:</strong> $ {$row['price']}</p>
            <p><strong>Description:</strong> {$row['description']}</p>
            <form method='POST' action='add_to_cart.php'>
    <input type='hidden' name='book_id' value='{$row['id']}'>
    <input type='number' name='quantity' value='1' min='1' style='width: 50px;'>
    <button type='submit'>Add to Cart</button>
</form>

        </div>";
    }
} else {
    echo "<p>No books available.</p>";
}
?>

<?php include_once 'includes/footer.php'; ?>
