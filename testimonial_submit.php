<?php
// testimonial_submit.php - VERSION RAHISI KWA TEST
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

// Check if it's POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "msg" => "Method not allowed"]);
    exit;
}

// Get data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;

// Validate
if (empty($name) || empty($email) || empty($message) || $rating < 1 || $rating > 5) {
    echo json_encode(["status" => "error", "msg" => "All fields are required and rating must be 1-5"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "msg" => "Invalid email format"]);
    exit;
}

// Database connection
try {
    $conn = new mysqli("localhost", "root", "", "mwalo_portfolio");
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Insert
    $stmt = $conn->prepare("INSERT INTO testimonials (name, email, title, message, rating) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $email, $title, $message, $rating);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "msg" => "Testimonial submitted successfully!"]);
    } else {
        throw new Exception("Failed to save: " . $stmt->error);
    }
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
}
?>