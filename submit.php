<?php
// Database credentials
$servername = "your-remote-mysql-host"; // Example: "mysql.render.com"
$username = "xbygrwxg_mscorp7"; // Your database username
$password = "ms7777ms"; // Your database password
$dbname = "xbygrwxg_mscorp7"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $comments = trim($_POST['comments']);

    // Prevent empty inputs
    if (!empty($name) && !empty($email) && !empty($comments)) {
        $stmt = $conn->prepare("INSERT INTO msform1 (name, email, comments) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $comments);

        if ($stmt->execute()) {
            echo "Submitted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required!";
    }
}

// Retrieve data from database
$sql = "SELECT * FROM msform1";
$result = $conn->query($sql);

$conn->close();
?>
