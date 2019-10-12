<?php
  session_start();
  require_once "pdo.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="w1.css">
  <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
  <title>TALLTON CHALACO LACERDA SANTOS ' Resume Registry </title>
</head>
<body>
  <header>
    <h1>Profile Information</h1>
  </header>
  <main>
    <?php
    $stmt = $pdo->prepare('SELECT first_name, last_name, email, headline, summary  FROM Profile WHERE profile_id = :em');
    $stmt->execute(array( ':em' => (is_numeric($_GET['profile_id'])) ? $_GET['profile_id'] : false));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row !== false) {
              echo('<p>First Name: '.htmlentities($row['first_name']).'</p>');
              echo('<p>Last Name: '.htmlentities($row['last_name']).'</p>');
              echo('<p>Email: '.htmlentities($row['email']).'</p>');
              echo('<p>Headline:</p><p>'.htmlentities($row['headline']).'</p>');
              echo('<p>Summary:</p><p>'.htmlentities($row['summary']).'</p>');
      }
      else {
        $_SESSION['error'] = '<p style=color:red>Could not load profile</p>';
        header('Location: index.php');
        return;
      }
      ?>
    <a href="index.php">Done</a>
  </main>
</body>
</html>
