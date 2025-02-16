<?php
// Database credentials from Render
$dsn = "pgsql:host=dpg-cup0buhu0jms73bipm6g-a;port=5432;dbname=mscorp;user=mahavir;password=VJ9K5LWQYimkHxbBgrW94VFz2943kJ3V";

try {
    $conn = new PDO($dsn);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert Data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $comments = trim($_POST['comments']);

        if (!empty($name) && !empty($email) && !empty($comments)) {
            $stmt = $conn->prepare("INSERT INTO msform1 (name, email, comments) VALUES (:name, :email, :comments)");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":comments", $comments);
            $stmt->execute();

            echo "Submitted successfully";
        } else {
            echo "All fields are required!";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
