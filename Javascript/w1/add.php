<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name'])) {
    die('Not logged in');
  }
  if(isset($_POST['add'])) {
    function isemail() {
      for($i = 0; $i < strlen($_POST['email']); $i++) {
        if($_POST['email'][$i] === '@') {
          return true;
        }
      }
      return false;
    }
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1 ) {
      $_SESSION['error'] = '<p style=color:red>All fields are required</p>';
      header('Location:add.php');
      return;
    }
    elseif((isemail()) ? false : true) {
      $_SESSION['error'] = '<p style=color:red>Email address must contain @</p>';
      header('Location:add.php');
      return;
    }
    else {
      $stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');
      $stmt->execute(array(':uid' => $_SESSION['user_id'], ':fn' => $_POST['first_name'], ':ln' => $_POST['last_name'], ':em' => $_POST['email'], ':he' => $_POST['headline'], ':su' => $_POST['summary']));
      $_SESSION['error'] = '<p style=color:green>Profile added</p>';
      header('Location:index.php');
      return;
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TALLTON CHALACO LACERDA SANTOS - ADD</title>
    <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="w1.css">
  </head>
  <body>
    <header>
      <h1>Adding Profile for <?= htmlentities($_SESSION['name'])?></h1>
      <?php
        if(isset($_SESSION['error'])) {
          echo($_SESSION['error']);
        }
        unset($_SESSION['error']);
      ?>
    </header>
    <main>
      <form method="post">
        <table>
          <tr><td>First Name: </td><td><input type="text" size="70" name="first_name"></td></tr>
          <tr><td>Last Name: </td><td><input type="text" size="70" name="last_name"></td></tr>
          <tr><td>User Email: </td><td><input type="text" size="70" name="email"></td></tr>
          <tr><td>Headline: </td><td><input type="text" size="70" name="headline"></td></tr>
        </table>
        <p>Summary:<br/>
        <textarea name="summary" rows="12" cols="80"></textarea>
        </p>
        <table>
          <tr><td><input type="submit" name="add" value="Add"></td>
          <td><input type="button" name="cancel" onclick="location.href='index.php'; return false;" value="Cancel"></td></tr>
        </table>
      </form>
    </main>
  </body>
</html>
