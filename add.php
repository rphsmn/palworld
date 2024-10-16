<?php
require_once 'connect.php';

if (isset($_POST['save'])) {
    $steam_ID = $_POST['steam_ID'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $country = $_POST['country'];
    $payment_method = $_POST['payment_method'];
    $updates = $_POST['updates'];

    insertData($steam_ID, $email, $username, $country, $payment_method, $updates);
    
    header('location: ty.php');
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="webimg/favicon.ico">
<title>Pre-Register | Palworld</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css" />
    <link rel="stylesheet" href="style/add.css" />
</head>
  <body style="background-image: url('webimg/bg2.jpg');">
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary" style="opacity: 0.9;" >
          <div class="panel-heading text-center">
            <h1>Pre-Register Now!</h1>
          </div>
          <div class="panel-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="steam_ID">Steam ID:</label>
                <input
                  type="text"
                  class="form-control"
                  id="steam_ID"
                  name="steam_ID"
                  required
                />
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  required
                />
              <div class="form-group">
                <label for="username"> In Game Username:</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  required
                />
              </div>
              <div class="form-group">
                <label for="country">Country:</label>
                <input
                  type="text"
                  class="form-control"
                  id="country"
                  name="country"
                  required
                />
                </div>
              <div class="form-group">
                <label for="payment_method">Payment Method (No information needed for now!):</label>
                <div>
                  <label for="payment_method" class="radio-inline"><input
                      type="radio"
                      name="payment_method"
                      value="gcash"
                      id="gcash"
                    />Gcash</label>

                  <label for="payment_method" class="radio-inline"><input
                      type="radio"
                      name="payment_method"
                      value="paymaya"
                      id="paymaya"
                    />Paymaya</label>

                  <label for="payment_method" class="radio-inline"><input
                      type="radio"
                      name="payment_method"
                      value="card"
                      id="card"
                    />Debit/Credit Card</label>

                </div>
              </div>
              <div class="form-group">
                <label for="updates">Recieve through your email updates and offers  from the Game?</label>
                <div>
                  <label for="updates" class="radio-inline"
                    ><input
                      type="radio"
                      name="updates"
                      value="yes"
                      id="yes"
                    />Yes, please!</label>
                  <label for="updates" class="radio-inline"><input
                      type="radio"
                      name="updates"
                      value="no"
                      id="no"
                    />No, thank you.</label>
                    
              </div><br>
              <div>
              <input type="submit" name="save" class="btn btn-primary" value="Register">
              <a href="index.php" class="btn btn-primary">Cancel</a>
            </form>
          </div>
          <div>
          <h6><span>Warning:</span> Editing is not available manually. Make sure all details are correct.
          To edit, send an email to <a href="https://mail.google.com/mail/u/1/#inbox?compose=DmwnWrRlRHpBlghdZsqtclMGWRrhgbHgwDjcnbmlsZLHGHTTWmBCPPLrPDXZFdRHQBBwxNKRFgHL">palworld.cs.idsc@gmail.com</a> for customer support.</h6>          
          
          <div class="panel-footer text-right">
            <small>&copy; Pocketpair Game Company alongside Ralph Samson of BSIT-2</small>
          </div>
        </div>
      </div>
    </div>
</div>
  </body>
</html>