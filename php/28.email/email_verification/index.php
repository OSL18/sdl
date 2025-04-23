<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure Composer is set up and this path is correct

// Database connection
$servername = "localhost";
$username = "root";
$password = "sahil";
$dbname = "email_verification";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $verification_code = md5(uniqid("email_verification_", true));

    $stmt = $conn->prepare("INSERT INTO users (name, email, verification_code) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $verification_code);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sahilambokar4@gmail.com'; // your Gmail address
            $mail->Password = 'vqhz ljxi rshq ecyq';    // Gmail App password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient settings
            $mail->setFrom('sahilambokar4@gmail.com', 'Sahil');
            $mail->addAddress($email, $name);

            // Email content
            $mail->Subject = 'Email Verification';
            $mail->Body    = "Click the link to verify your email:\nhttp://localhost/verify_email.php?code=" . $verification_code;

            $mail->send();
            echo "Registration successful! Please check your email to verify your account.";
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle verification
if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE verification_code = ?");
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (!$user['email_verified']) {
            $stmt_update = $conn->prepare("UPDATE users SET email_verified = 1 WHERE verification_code = ?");
            $stmt_update->bind_param("s", $verification_code);
            if ($stmt_update->execute()) {
                echo "Your email has been successfully verified!";
            } else {
                echo "Error verifying email.";
            }
        } else {
            echo "Your email is already verified.";
        }
    } else {
        echo "Invalid verification link.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body>
    <h2>User Registration</h2>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
