<?php
session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name']) ) {
    die("Not logged in");
  }
  if ( isset($_POST['cancel']) ) {
      header('Location: view.php');
      return;
  }
  if (isset($_POST['make']) and strlen($_POST['make']) < 1) {
    $_SESSION['error'] = 'Make is required';
    header('Location: add.php');
    return;
  }
  elseif(isset($_POST['year']) && isset($_POST['mileage'])) {
    if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
      $_SESSION['error'] = 'Mileage and year must be numeric';
      header('Location: add.php');
      return;
    }
    else {
      $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)');
      $stmt->execute(array(
        ':mk' => $_POST['make'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage']));
      $_SESSION['success'] = 'Record inserted';
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
  <h1>Tracking Autos for <?= htmlentities($_SESSION['name'])?> </h1>
</header>
<main>
  <?php
    if(isset($_SESSION['error'])) {
      echo('<p style="color:red";>'.$_SESSION['error'].'</p>');
      unset($_SESSION['error']);
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
