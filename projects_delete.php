<?php
session_start();

// Check login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
$db_path = __DIR__ . '/../db.php';
if (file_exists($db_path)) {
    require_once $db_path;
} else {
    require_once "db.php";
}

// Get and validate ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Get image info before deleting
    $project = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM projects WHERE id = $id"));
    
    // Delete from database
    $result = mysqli_query($conn, "DELETE FROM projects WHERE id = $id");
    
    if ($result) {
        // Delete image file if exists
        if ($project && !empty($project['image']) && file_exists("../asset/" . $project['image'])) {
            unlink("../asset/" . $project['image']);
        }
        header("Location: projects.php?msg=deleted");
    } else {
        header("Location: projects.php?error=delete_failed");
    }
} else {
    header("Location: projects.php");
}
exit;
?>