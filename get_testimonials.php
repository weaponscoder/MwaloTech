<?php
// get_testimonials.php - VERSION RAHISI
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    $conn = new mysqli("localhost", "root", "", "mwalo_portfolio");
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    $result = $conn->query("SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 10");
    $testimonials = [];
    
    while ($row = $result->fetch_assoc()) {
        $testimonials[] = $row;
    }
    
    echo json_encode($testimonials);
    
    $conn->close();
    
} catch (Exception $e) {
    echo json_encode([]);
}
?>