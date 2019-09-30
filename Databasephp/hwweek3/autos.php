<?php
  session_start();
  require_once "pdo.php";
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
  if (isset($_POST['add']) && !$message) {

    $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'])
        );
      $_SESSION['msgsuccess'] = 'Record Inserted';
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
  <h1>Tracking Autos for <?= htmlentities($_GET['name'])?> </h1>
</header>
<main>
  <?php
    if($message !== false)
    {
      echo('<p style="color:red";>'.$message.'</p>');
    }
    else if(isset($_SESSION['msgsuccess'])) {
      echo('<p style="color:green";>'.$_SESSION['msgsuccess'].'</p>');
      unset($_SESSION['msgsuccess']);
    }
  ?>
  <form method="post">
  <table>
    <tr><td>Make</td><td><input type="text" name="make" size="60"></td></tr>
    <tr><td>Year:</td><td><input type="text" name="year" size="60"></td></tr>
    <tr><td>Mileage:</td><td><input type="text" name="mileage" size="60"></td></tr>
    <tr><td><input type="submit" name="add" value="Add"></td><td><input type="submit" name="logout" value="Logout"></td></tr>
  </table>
  </form>
  <div id="result">
    <h1>Automobiles<br></h1>
    <?php
    $stmt = $pdo->query("SELECT make, year, mileage FROM autos");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo(htmlentities($row['year']).' ');
      echo(htmlentities($row['make']).' / ');
      echo(htmlentities($row['mileage']));
      echo nl2br("\n");
    }
    ?>
  </div>
</main>
</body>
</html>
