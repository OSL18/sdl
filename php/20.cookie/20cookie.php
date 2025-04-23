<?php
// Initialize variables
$cookieName = "";
$cookieValue = "";
$cookieExpiry = "";
$message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if we're setting a cookie
    if (isset($_POST["action"]) && $_POST["action"] == "set") {
        if (isset($_POST["cookie_name"]) && isset($_POST["cookie_value"]) && isset($_POST["cookie_expiry"])) {
            $cookieName = $_POST["cookie_name"];
            $cookieValue = $_POST["cookie_value"];
            $cookieExpiry = intval($_POST["cookie_expiry"]);
            
            // Validate inputs
            if (empty($cookieName)) {
                $message = "Error: Cookie name cannot be empty.";
            } elseif ($cookieExpiry < 0) {
                $message = "Error: Expiry time must be a positive number.";
            } else {
                // Set the cookie
                $expiryTime = time() + ($cookieExpiry * 60); // Convert minutes to seconds
                setcookie($cookieName, $cookieValue, $expiryTime, "/");
                $message = "Cookie '$cookieName' set successfully! It will expire in $cookieExpiry minutes.";
            }
        }
    }
    // Check if we're viewing all cookies
    elseif (isset($_POST["action"]) && $_POST["action"] == "view") {
        // Handled in the HTML part
    }
    // Check if we're deleting a cookie
    elseif (isset($_POST["action"]) && $_POST["action"] == "delete") {
        if (isset($_POST["delete_cookie"])) {
            $cookieToDelete = $_POST["delete_cookie"];
            
            // Check if the cookie exists
            if (isset($_COOKIE[$cookieToDelete])) {
                // Delete the cookie by setting expiry time in the past
                setcookie($cookieToDelete, "", time() - 3600, "/");
                $message = "Cookie '$cookieToDelete' deleted successfully!";
            } else {
                $message = "Error: Cookie '$cookieToDelete' does not exist.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Cookie Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .section {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .message {
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .delete-button {
            background-color: #f44336;
        }
        .delete-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP Cookie Manager</h1>
        
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, "Error") === 0 ? "error" : "success"; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <div class="section">
            <h2>Set a Cookie</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="action" value="set">
                
                <div class="form-group">
                    <label for="cookie_name">Cookie Name:</label>
                    <input type="text" id="cookie_name" name="cookie_name" required>
                </div>
                
                <div class="form-group">
                    <label for="cookie_value">Cookie Value:</label>
                    <input type="text" id="cookie_value" name="cookie_value" required>
                </div>
                
                <div class="form-group">
                    <label for="cookie_expiry">Expiry Time (minutes):</label>
                    <input type="number" id="cookie_expiry" name="cookie_expiry" value="60" required>
                </div>
                
                <button type="submit">Set Cookie</button>
            </form>
        </div>
        
        <div class="section">
            <h2>View Cookies</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="action" value="view">
                <button type="submit">Refresh Cookie List</button>
            </form>
            
            <?php if (count($_COOKIE) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Cookie Name</th>
                            <th>Cookie Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_COOKIE as $name => $value): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($name); ?></td>
                                <td><?php echo htmlspecialchars($value); ?></td>
                                <td>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="delete_cookie" value="<?php echo htmlspecialchars($name); ?>">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No cookies found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>