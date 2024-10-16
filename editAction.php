<?php

// Configuration variables
$databaseHost = 'localhost';
$databaseName = 'palworld';
$databaseUsername = 'root';
$databasePassword = '';

// Connect to database
$conn = new PDO("mysql:host=$databaseHost;dbname=$databaseName", $databaseUsername, $databasePassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get id from URL parameter
$id = $_POST['id'];


// Update database record
$stmt = $conn->prepare("UPDATE wishlist SET steam_ID = :steam_ID, email = :email, username = :username, country = :country, payment_method = :payment_method, updates = :updates WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':steam_ID', $_POST['steam_ID']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':username', $_POST['username']);
$stmt->bindParam(':country', $_POST['country']);
$stmt->bindParam(':payment_method', $_POST['payment_method']);
$stmt->bindParam(':updates', $_POST['updates']);
$stmt->execute();

// Redirect to edit.php with success message
header("Location: record.php?id=$id&success=1");
exit;

// Close database connection
$conn = null;

// Confirmation text
echo "Record updated successfully!";

?>