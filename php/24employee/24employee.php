<?php
// Initialize variables
$searchName = "";
$searchResult = "";
$searchPerformed = false;

// Create an indexed array of 20 employee names
$employees = [
    "John Smith",
    "Emily Johnson",
    "Michael Williams",
    "Jessica Brown",
    "William Jones",
    "Sarah Miller",
    "David Davis",
    "Amanda Wilson",
    "Robert Moore",
    "Jennifer Taylor",
    "James Anderson",
    "Lisa Thomas",
    "Joseph Jackson",
    "Stephanie White",
    "Christopher Harris",
    "Rebecca Martin",
    "Daniel Thompson",
    "Michelle Garcia",
    "Matthew Martinez",
    "Elizabeth Robinson"
];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_name"])) {
    $searchName = trim($_POST["search_name"]);
    $searchPerformed = true;
    
    // Perform search
    $found = false;
    $position = -1;
    
    foreach ($employees as $index => $name) {
        // Case-insensitive search
        if (strtolower($name) === strtolower($searchName)) {
            $found = true;
            $position = $index;
            break;
        }
    }
    
    // Prepare result message
    if ($found) {
        $searchResult = "<div class='alert alert-success'>
            <strong>Found!</strong> The employee '$searchName' exists in the array at position $position.
        </div>";
    } else {
        $searchResult = "<div class='alert alert-danger'>
            <strong>Not Found!</strong> The employee '$searchName' does not exist in the array.
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .employee-list {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            background-color: #f8f9fa;
        }
        .employee-item {
            padding: 8px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .employee-item:last-child {
            border-bottom: none;
        }
        .highlight {
            background-color: #d4edda;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Employee Search</h1>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Search Employee</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="search_name" class="form-label">Employee Name:</label>
                                <input type="text" class="form-control" id="search_name" name="search_name" placeholder="Enter employee name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        
                        <?php if ($searchPerformed): ?>
                            <div class="mt-3">
                                <?php echo $searchResult; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Employee List (<?php echo count($employees); ?> employees)</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="employee-list">
                            <?php foreach ($employees as $index => $name): ?>
                                <div class="employee-item <?php echo ($searchPerformed && strtolower($name) === strtolower($searchName)) ? 'highlight' : ''; ?>">
                                    <?php echo ($index + 1) . ". " . $name; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>