<?php

// Configuration variables
$databaseHost = 'localhost';
$databaseName = 'palworld';
$databaseUsername = 'root';
$databasePassword = '';

// Function to get database connection
function getDatabaseConnection()
{
    global $databaseHost, $databaseName, $databaseUsername, $databasePassword;

    try {
        $conn = new PDO("mysql:host=$databaseHost;dbname=$databaseName", $databaseUsername, $databasePassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
        return null;
    }
}

// Function to insert data into the database
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
        } catch(PDOException $e) {
            echo "Data Insertion Failed: ". $e->getMessage();
            return false;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<title>Record Page | Palworld</title>
<head>
    <link rel="stylesheet" href="style/record.css">
    <link rel="icon" href="webimg/favicon.ico">
</head>
<body>

<h2>InfoTable of Pre-registered Users:</h2>

<table>
  <tr>
    <th>Steam ID</th>
    <th>Email</th>
    <th>In Game Username</th>
    <th>Country</th>
    <th>Payment Method</th>
    <th>To Recieve Updates</th>
    <th>Actions</th>
  </tr>
  <div class="button-container">
  <a href="index.php" onclick="return confirm('Are you sure you want to logout?')" class="button">Logout & Return to Homepage</a>
  </div>
  <br></br>
  <?php
        $conn = getDatabaseConnection();
        $result = $conn->query("SELECT * FROM wishlist ORDER BY id DESC");

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>". htmlspecialchars($row['steam_ID']). "</td>";
                echo "<td>". htmlspecialchars($row['email']). "</td>";
                echo "<td>". htmlspecialchars($row['username']). "</td>";
                echo "<td>". htmlspecialchars($row['country']). "</td>";
                echo "<td>". htmlspecialchars($row['payment_method']). "</td>";
                echo "<td>". htmlspecialchars($row['updates']). "</td>";
                echo "<td>
                <a href='edit.php?id=". $row['id']. "' style='text-decoration: none'>Edit</a> |
                <a href='delete.php?id=". $row['id']. "' onclick=\"return confirm('Are you sure you want to delete?')\" style='text-decoration: none'>Delete</a>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
       ?>
</table>

</body>
</html>