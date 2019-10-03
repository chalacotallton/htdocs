<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name'])) {
    die('<p style="font-size:130%">'.'ACCESS DENIED'.'</p>');
  }
  if(isset($_POST['cancel'])) {
    header("location: index.php");
  }
  if(isset($_POST['add'])) {
    if(strlen(htmlentities($_POST['make'])) <= 0 || strlen(htmlentities($_POST['model'])) <= 0 || strlen(htmlentities($_POST['year'])) <= 0 || strlen(htmlentities($_POST['mileage'])) <= 0) {
      $_SESSION['error'] = '<p style="color:red">'.'All fields are required'.'</p>';
      header("location:".$_SERVER["REQUEST_URI"]);
      return;
    }
    elseif (!is_numeric($_POST['year'])) {
      $_SESSION['error'] = '<p style="color:red">'.'Year must be numeric'.'</p>';
      header("location:".$_SERVER["REQUEST_URI"]);
      return;
    }
    elseif (!is_numeric($_POST['mileage'])) {
      $_SESSION['error'] = '<p style="color:red">'.'Mileage must be numeric'.'</p>';
      header("location:".$_SERVER["REQUEST_URI"]);
      return;
    }
    else {
      $sql = "INSERT INTO autos(make, model, year, mileage)VALUES(:b, :c, :d, :e)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':b' => $_POST['make'],
        ':c' => $_POST['model'],
        ':d' => $_POST['year'],
        ':e' => $_POST['mileage']
      ));
      $_SESSION['error'] = '<p style="color:green">'.'Record Added'.'</p>';
      header("location: index.php");
      return;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tallton Chalaco Lacerda Santos - Automobile Tracker</title>
</head>
<body>
  <header>
    <p>Tracking Automobiles for <?= $_SESSION['name']?></p>
    <?php
    if(isset($_SESSION['error'])) {
      echo($_SESSION['error']);
      unset($_SESSION['error']);
    }
    ?>
  </header>
  <main>
    <form method="post">
      <table>
        <tr><td><label for="name">Make:
        <td><input type="text" size="40" name="make"></tr>
        <tr><td><label for="model">Model:
        <td><input type="text" size="40" name="model"></tr>
        <tr><td><label for="year">Year:
        <td><input type="text" size="40" name="year"></tr>
        <tr><td><label for="mileage">Mileage:
        <td><input type="text" size="40" name="mileage"></tr>
        <td><input type="submit" name="add" value="Add">
        <td><input type="submit" name="cancel" value="Cancel"></tr>
      </table>
    </form>
  </main>
</body>
</html>
