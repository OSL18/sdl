<?php include '../includes/header.php'; include '../config/db.php'; ?>

<h2>Add Product</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Product Name"><br>
    <input type="number" step="0.01" name="price" placeholder="Price"><br>
    <input type="text" name="image" placeholder="Image Filename"><br>
    <input type="submit" name="add" value="Add">
</form>

<?php
if (isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $_POST['name'], $_POST['price'], $_POST['image']);
    $stmt->execute();
    echo "<p>Product added successfully!</p>";
}
$conn->close();
?>

<?php include '../includes/footer.php'; ?>
