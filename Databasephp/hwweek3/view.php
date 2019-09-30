<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['LOGIN']) ) {
    die("Not logged in");
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
    if(isset($_SESSION['msgsuccess'])) {
      echo('<p style="color:green">'.$_SESSION['msgsuccess'].'</p>');
      unset($_SESSION['msgsuccess']);
    }
    ?>
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
    <p>
      <a href="add.php">Add New </a> <span>|</span>
      <a href="logout.php">Logout </a>
    </p>
</main>
</body>
</html>
