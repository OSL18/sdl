<!DOCTYPE html>
<html>
<head>
    <title>Array Operations with Numbers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"] {
            padding: 8px;
            margin: 5px 0;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            background-color: #e9f7ef;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Number Array Operations</h1>
        
        <form method="post" action="">
            <label for="numbers">Enter numbers separated by commas:</label><br>
            <input type="text" id="numbers" name="numbers" placeholder="e.g., 5, 2, 9, 1, 7" size="40"><br><br>
            <input type="submit" name="submit" value="Process Numbers">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numbers'])) {
            // Get input and trim whitespace
            $input = trim($_POST['numbers']);
            
            if (!empty($input)) {
                // Split the input string into an array
                $numberStrings = explode(',', $input);
                
                // Initialize an empty array for numbers
                $numbers = array();
                
                // Convert each string to a number and add to the array
                foreach ($numberStrings as $numStr) {
                    $num = trim($numStr);
                    if (is_numeric($num)) {
                        $numbers[] = (float)$num;
                    }
                }
                
                if (!empty($numbers)) {
                    // Calculate sum
                    $sum = array_sum($numbers);
                    
                    // Sort the array
                    sort($numbers);
                    
                    // Display results
                    echo '<div class="result">';
                    echo '<h3>Results:</h3>';
                    echo '<p><strong>Original Numbers:</strong> ' . htmlspecialchars($input) . '</p>';
                    echo '<p><strong>Valid Numbers Extracted:</strong> ' . implode(', ', $numbers) . '</p>';
                    echo '<p><strong>Sorted Numbers:</strong> ' . implode(', ', $numbers) . '</p>';
                    echo '<p><strong>Sum of Numbers:</strong> ' . $sum . '</p>';
                    echo '</div>';
                } else {
                    echo '<div class="result" style="background-color:#ffebee;">';
                    echo '<p>No valid numbers found in the input.</p>';
                    echo '</div>';
                }
            } else {
                echo '<div class="result" style="background-color:#ffebee;">';
                echo '<p>Please enter some numbers.</p>';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>