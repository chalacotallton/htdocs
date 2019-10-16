<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name'])) {
    die('Not logged in');
  }
  if(isset($_POST['delete'])) {
    $stmt = $pdo->prepare('DELETE  FROM Profile WHERE profile_id = :em');
    $stmt->execute(array( ':em' => $_GET['profile_id']));
    $_SESSION['error'] = '<p style=color:green>Profile deleted</p>';
    header('Location: index.php');
    return;
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="w1.css">
    <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <title>TALLTON CHALACO LACERDA SANTOS ' Resume Registry </title>
  </head>
  <body>
    <header>
      <h1>Deleting Profile</h1>
    </header>
    <main>
      <?php
      $stmt = $pdo->prepare('SELECT first_name, last_name, email, headline, summary  FROM Profile WHERE profile_id = :em');
      $stmt->execute(array( ':em' => (is_numeric($_GET['profile_id'])) ? $_GET['profile_id'] : false));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row !== false) {
                echo('<p>First Name: '.htmlentities($row['first_name']).'</p>');
                echo('<p>Last Name: '.htmlentities($row['last_name']).'</p>');
        }
        else {
          $_SESSION['error'] = '<p style=color:red>Could not load profile</p>';
          header('Location: index.php');
          return;
        }
        ?>
        <form method="post">
          <table>
            <tr><td><input type="submit" name="delete" value="Delete"></td>
            <td><input type="button" name="cancel" onclick="location.href='index.php'; return false;" value="Cancel"></td></tr>
          </table>
        </form>
    </main>
  </body>
</html>
