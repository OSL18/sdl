<!DOCTYPE html>
<html>
<head>
  <title>Complaint Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
</head>
<body>
  <h2>Submit Your Complaint</h2>
  <form action="submit.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Subject:</label><br>
    <input type="text" name="subject"><br><br>

    <label>Complaint:</label><br>
    <textarea name="message" rows="4" required></textarea><br><br>

    <input type="submit" value="Submit Complaint">
  </form>
  <br>
  <a href="view.php">View Complaints</a>
</body>
</html>
