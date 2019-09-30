<?php
session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['LOGIN']) ) {
    die("Not logged in");
  }
  if ( isset($_POST['cancel']) ) {
      header('Location: view.php');
      return;
  }
  $message = false;
  if (isset($_POST['make']) and strlen($_POST['make']) < 1) {
    $message = 'Make is required';
  }
  elseif(isset($_POST['year']) && isset($_POST['mileage'])) {
    if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
      $message = 'Mileage and year must be numeric';
    }
    else {
      $_SESSION['msgsuccess'] = 'Record inserted';
      ;//add to database here;
      header('Location:view.php');
      return;
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>TALLTON CHALACO LACERDA SANTOS - Autos Database</title>
  <meta charset="UTF-8">
  <link type="text/css" rel="stylesheet" href="css.css">
  <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
</head>
<body>
<header>
  <h1>Tracking Autos for <?= htmlentities($_SESSION['who'])?> </h1>
</header>
<main>
  <?php
    if($message !== false)
    {
      echo('<p style="color:red";>'.$message.'</p>');
    }
  ?>
  <form method="post">
  <table>
    <tr><td>Make</td><td><input type="text" name="make" size="60"></td></tr>
    <tr><td>Year:</td><td><input type="text" name="year" size="60"></td></tr>
    <tr><td>Mileage:</td><td><input type="text" name="mileage" size="60"></td></tr>
    <tr><td><input type="submit" name="add" value="Add"></td><td><input type="submit" name="cancel" value="Cancel"></td></tr>
  </table>
  </form>
</main>
</body>
</html>
