<?php
  session_start();
  if(!isset($_SESSION['LOGIN']) || !isset($_GET['name'])) {
    die("Name parameter missing");
  }
  if ( isset($_POST['logout']) ) {
      unset($_SESSION['LOGIN']);
      header('Location: index.php');
      return;
  }
  $message = false;
  if (isset($_POST['make']) and strlen($_POST['make']) < 1) {
    $message = 'Make is required';
  }
  else if(isset($_POST['year']) && isset($_POST['mileage'])) {
    if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage']))
    $message = 'Mileage and year must be numeric';
  }
  echo($message);
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
  <h1>Tracking Autos for <?= htmlentities($_GET['name'])?> </h1>
</header>
<main>
  <form method="post">
  <table>
    <tr><td>Make</td><td><input type="text" name="make" size="60"></td></tr>
    <tr><td>Year:</td><td><input type="text" name="year" size="60"></td></tr>
    <tr><td>Mileage:</td><td><input type="text" name="mileage" size="60"></td></tr>
    <tr><td><input type="submit" name="add" value="Add"></td><td><input type="submit" name="logout" value="Logout"></td></tr>
  </table>
  </form>
  <div>
    <h1>Automobiles<br></h1>

  </div>
</main>
</body>
</html>
