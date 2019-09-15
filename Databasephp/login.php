<?php
  session_start();
  if(isset($_POST["acc"]) && isset($_POST["psw"])) {
    unset($_SESSION['account']);
    if($_POST['psw'] == '1234' ) {
      $_SESSION["account"] = $_POST["acc"];
      $_SESSION["success"] = "Logged in.";
      header ('Location: app.php');
      return;
    }
    else if (strlen($_POST["acc"]) < 1 OR   strlen($_POST["psw"]) < 1) {
      $_SESSION["error"] = "You need to insert both account and password.";
      header("location: login.php");
      return;
    }
    else {
      $_SESSION["error"] = "Incorrect password.";
      header("location: login.php");
      return;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Tab</title>
</head>
<body style="font-family: sans-serif">
  <h1>Please Log in</h1>
  <?php
    if (isset($_SESSION["error"])) {
      echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
      unset($_SESSION["error"]);
    }
    if (isset($_SESSION["success"])) {
      echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
      unset($_SESSION["success"]);
    }
  ?>
  <form method="post">
      <p><label for="acc">Account:</label>
      <input type="text" name="acc" id="acc" size="40"></p>
      <p><label for="psw">Password:</label>
      <input type="password" name="psw" id="psw" size="40"></p>
      <p><input type="submit" name="submit" value="Log in">
      <a href="app.php">Cancel</a>
  </form>
</body>
</html>
