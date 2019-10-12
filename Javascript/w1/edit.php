<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name'])) {
    die('Not logged in');
  }
  if(isset($_POST['edit'])) {
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
      header('Location:edit.php?profile_id='.htmlentities($_GET['profile_id']));
      return;
    }
    elseif((isemail()) ? false : true) {
      $_SESSION['error'] = '<p style=color:red>Email address must contain @</p>';
      header('Location:edit.php?profile_id='.htmlentities($_GET['profile_id']));
      return;
    }
    else {
      $sql = "UPDATE Profile SET first_name=:b, last_name=:c, email=:d, headline=:f, summary=:e WHERE profile_id=:a";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':a' => $_GET['profile_id'],
        ':b' => $_POST['first_name'],
        ':c' => $_POST['last_name'],
        ':d' => $_POST['email'],
        ':e' => $_POST['headline'],
        ':f' => $_POST['summary']
      ));
      $_SESSION['error'] = '<p style="color:green">Profile updated</p>';
      header("location: index.php");
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
      <h1>Editing Profile for <?= htmlentities($_SESSION['name'])?></h1>
      <?php
        if(isset($_SESSION['error'])) {
          echo($_SESSION['error']);
        }
        unset($_SESSION['error']);
      ?>
    </header>
    <main>
      <?php
      $stmt = $pdo->prepare('SELECT first_name, last_name, email, headline, summary  FROM Profile WHERE profile_id = :em');
      $stmt->execute(array( ':em' => (is_numeric($_GET['profile_id'])) ? $_GET['profile_id'] : false));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false) {
          $_SESSION['error'] = '<p style=color:red>Could not load profile</p>';
          header('Location: index.php');
          return;
        }
      ?>
      <form method="post">
        <table>
          <tr><td>First Name: </td><td><input type="text" size="70" name="first_name" value="<?=htmlentities($row['first_name'])?>"></td></tr>
          <tr><td>Last Name: </td><td><input type="text" size="70" name="last_name" value="<?=htmlentities($row['last_name'])?>"></td></tr>
          <tr><td>User Email: </td><td><input type="text" size="70" name="email" value="<?=htmlentities($row['email'])?>"></td></tr>
          <tr><td>Headline: </td><td><input type="text" size="70" name="headline" value="<?=htmlentities($row['headline'])?>"></td></tr>
        </table>
        <p>Summary:<br/>
        <textarea name="summary" rows="12" cols="80"><?=htmlentities($row['summary'])?></textarea>
        </p>
        <table>
          <tr><td><input type="submit" name="edit" value="Save"></td>
          <td><input type="button" name="cancel" onclick="location.href='index.php'; return false;" value="Cancel"></td></tr>
        </table>
      </form>
    </main>
  </body>
</html>
