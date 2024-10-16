<?php

function getDatabaseConnection()
{
    $databaseHost = 'localhost';
    $databaseName = 'palworld';
    $databaseUsername = 'root';
    $databasePassword = '';

    try {
        $conn = new PDO("mysql:host=$databaseHost;dbname=$databaseName", $databaseUsername, $databasePassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
        return null;
    }
}

function insertData($steam_ID, $email, $username, $country, $payment_method, $updates)
{
    $conn = getDatabaseConnection();
    if ($conn){
        try {
            $stmt = $conn->prepare("INSERT INTO wishlist (steam_ID, email, username, country, payment_method, updates) VALUES (:steam_ID, :email, :username, :country, :payment_method, :updates)");
            $stmt->bindParam(':steam_ID', $steam_ID);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':payment_method', $payment_method);
            $stmt->bindParam(':updates', $updates);
            $stmt->execute();
            return $conn->lastInsertId();
        }  catch(PDOException $e) {
            echo "Data Insertion Failed: ". $e->getMessage();
            return false;
        }
    }
}
?>
