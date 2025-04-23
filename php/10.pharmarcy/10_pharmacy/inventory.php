<?php
require 'db.php';
$medicines = $conn->query("SELECT * FROM medicines ORDER BY expiry_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Medicine Inventory</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Inventory</h2>
  <a href="index.php">Add New Medicine</a>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Type</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Expiry</th>
    </tr>
    <?php while($row = $medicines->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['type'] ?></td>
      <td>₹<?= $row['price'] ?></td>
      <td><?= $row['quantity'] ?></td>
      <td><?= $row['expiry_date'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
