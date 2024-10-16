<?php
// Configuration variables
$databaseHost = 'localhost';
$databaseName = 'palworld';
$databaseUsername = 'root';
$databasePassword = '';

// Connect to database
$conn = new PDO("mysql:host=$databaseHost;dbname=$databaseName", $databaseUsername, $databasePassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['username']) || empty($_POST['password'])) {
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Authenticate user
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Redirect to dashboard
            header("Location: record.php");
            exit;
        } else {
            echo "<script type='text/javascript'>alert('Invalid Username and Password');</script>";
        }
    }
}

// Close database connection
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="icon" href="webimg/favicon.ico">
</head>
<body>
    <form action="admin.php" method="post">
        <h3>Login</h3>
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit">Log In</button>
        <div class="social" class="bck">
            <a id="back" href="index.php" class="btn btn-primary">Back</a>
        </div>
    </form>
</body>
</html>