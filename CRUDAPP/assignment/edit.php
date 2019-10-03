<?php
  session_start();
  require_once "pdo.php";
  if(isset($_POST['cancel'])) {
    header("location: index.php");
  }
  if(!isset($_SESSION['name'])) {
    die('<p style="font-size:130%">'.'ACCESS DENIED'.'</p>');
  }
  if(isset($_GET['autos_id']) && is_numeric($_GET['autos_id'])) {
    $prtstmt = $pdo->prepare("SELECT make, model, year, mileage FROM autos WHERE autos_id=:id LIMIT 1");
    $prtstmt->execute(array(':id'=>$_GET['autos_id']));
    $row = $prtstmt->fetch(PDO::FETCH_ASSOC);
    if(strlen($row['make']) > 0) {
      if(isset($_POST['save'])) {
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
          $sql = "UPDATE autos SET make=:b, model=:c, year=:d, mileage=:e WHERE autos_id=:a";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
            ':a' => $_GET['autos_id']+0,
            ':b' => $_POST['make'],
            ':c' => $_POST['model'],
            ':d' => $_POST['year'],
            ':e' => $_POST['mileage']
          ));
          $_SESSION['error'] = '<p style="color:green">'.'Record edited'.'</p>';
          header("location: index.php");
          return;
        }
      }
    }
    else {
      $_SESSION['error'] = '<p style="color:red">'.'Bad value for id'.'</p>';
      header("location: index.php");
      return;
    }
  }
  else {
    $_SESSION['error'] = '<p style="color:red">'.'Bad value for id'.'</p>';
    header("location: index.php");
    return;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tallton Chalaco Lacerda Santos - Automobile Tracker</title>
</head>
<body>
  <header>
    <h1>Editing Automobile</h1>
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
      <tr><td><label for="make">Make:</label></td>
      <td><input type="text" size="40" id="make" name="make" value=<?=htmlentities($row['make'])?>></tr>
      <tr><td><label for="model">Model:</label></td>
      <td><input type="text" size="40" id="model" name="model" value=<?=htmlentities($row['model'])?>></tr>
      <tr><td><label for="year">Year:</label></td>
      <td><input type="text" size="40" id="year" name="year" value=<?=htmlentities($row['year'])?>></tr>
      <tr><td><label for="mileage">Mileage:</label></td>
      <td><input type="text" size="40" id="mileage" name="mileage" value=<?=htmlentities($row['mileage'])?>></tr>
      <tr><td><input type="submit" name="save" value="Save"></td>
      <td><input type="submit" name="cancel" value="Cancel"></td></tr>
      </table>
    </form>
  </main>
</body>
</html>
