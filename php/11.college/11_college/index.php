<!DOCTYPE html>
<html>
<head>
  <title>College Admission Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>College Admission Form</h2>
  <form action="submit.php" method="POST">
    <label>Full Name:</label>
    <input type="text" name="fullname" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Phone:</label>
    <input type="text" name="phone" required>

    <label>Date of Birth:</label>
    <input type="date" name="dob" required>

    <label>Gender:</label>
    <select name="gender" required>
      <option value="">Select Gender</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>

    <label>Course:</label>
    <select name="course" required>
      <option value="">Select Course</option>
      <option>B.E. Computer</option>
      <option>B.E. Civil</option>
      <option>B.E. Mechanical</option>
      <option>B.E. Electrical</option>
    </select>

    <label>Address:</label>
    <textarea name="address" rows="3" required></textarea>

    <input type="submit" value="Submit Application">
  </form>
  <br>
  <a href="view.php">View Applications</a>
</div>
</body>
</html>
