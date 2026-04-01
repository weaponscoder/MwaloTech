<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once "../db.php";

$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM services WHERE id = $id");

header("Location: services.php");
exit;
?>