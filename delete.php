<?php

// Include the database connection file
require_once("connect.php");

// Configuration variables
$databaseHost = 'localhost';
$databaseName = 'palworld';
$databaseUsername = 'root';
$databasePassword = '';

// Connect to database
$conn = new PDO("mysql:host=$databaseHost;dbname=$databaseName", $databaseUsername, $databasePassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get id from URL parameter
$id = $_GET['id'];
function deleteData($id){
// confirmation pop-up
if (confirm("Are you sure you want to delete this record? Elina-san?")) {
    // Delete database record
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirect to index.php with success message
    header("Location: record.php?success=1");
    exit;
    }
}

// Delete record from database
$stmt = $conn->prepare("DELETE FROM wishlist WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

// Redirect to record.php with success message
header("Location: record.php");
exit;

// Close database connection
$conn = null;

?>