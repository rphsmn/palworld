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
$id = $_GET['id'];

// Select data associated with this particular ID
$stmt = $conn->prepare("SELECT * FROM wishlist WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$resultData = $stmt->fetch();

if ($resultData) {
    $steam_ID = $resultData['steam_ID'];
    $email = $resultData['email'];
    $username = $resultData['username'];
    $country = $resultData['country'];
    $payment_method = $resultData['payment_method'];
    $updates = $resultData['updates'];
} else {
    echo "Record not found!";
    exit;
}
?>

<!-- HTML and PHP code to display the update form -->
<html>
<head>
    <link rel="stylesheet" href="style/edit.css">
    <link rel="icon" href="webimg/favicon.ico">
    <title>Edit Record Data | Palworld</title>
</head>
<body>
    <div class="box">
        <h2>Edit Data</h2>
        <form name="edit" method="post" action="editAction.php">
            <table style="margin-bottom: 20px;">
                <tr>
                    <td>Steam ID:</td>
                    <td><input type="text" name="steam_ID" value="<?php echo $steam_ID;?>"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $email;?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username;?>"></td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td><input type="text" name="country" value="<?php echo $country;?>"></td>
                </tr>
                <tr>
                    <td>Payment Method:</td>
                    <td>
                        <select name="payment_method">
                            <option value="gcash" <?php if ($payment_method == "gcash") echo "selected";?>>GCash</option>
                            <option value="paymaya" <?php if ($payment_method == "paymaya") echo "selected";?>>PayMaya</option>
                            <option value="card" <?php if ($payment_method == "card") echo "selected";?>>Card</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Stay Updated?</td>
                    <td>
                        <select name="updates">
                            <option value="yes" <?php if ($updates == "yes") echo "selected";?>>Yes</option>
                            <option value="no" <?php if ($updates == "no") echo "selected";?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input class="button" type="submit" name="update" value="Update">
                    </td>
                </tr>
                <br></br>
            </table>
        </form>
    </div>
</body>
</html>

<?php
// Close database connection
$conn = null;
?>