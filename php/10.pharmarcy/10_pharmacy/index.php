<!DOCTYPE html>
<html>
<head>
  <title>Add Medicine</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Add New Medicine</h2>
  <form method="POST" action="">
    <label>Medicine Name:</label>
    <input type="text" name="name" required>

    <label>Type (Tablet/Syrup):</label>
    <input type="text" name="type" required>

    <label>Price (per unit):</label>
    <input type="number" step="0.01" name="price" required>

    <label>Quantity:</label>
    <input type="number" name="quantity" required>

    <label>Expiry Date:</label>
    <input type="date" name="expiry_date" required>

    <input type="submit" name="add" value="Add Medicine">
  </form>
  <br>
  <a href="inventory.php">View Inventory</a>
</div>

<?php
require 'db.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];

    $sql = "INSERT INTO medicines (name, type, price, quantity, expiry_date)
            VALUES ('$name', '$type', '$price', '$quantity', '$expiry_date')";

    if ($conn->query($sql)) {
        echo "<p style='color:green; text-align:center;'>Medicine added successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . $conn->error . "</p>";
    }
}
?>
</body>
</html>
