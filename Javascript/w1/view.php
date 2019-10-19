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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
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
              $stmt = $pdo->prepare('SELECT year, institution_id FROM Education WHERE profile_id = :em ORDER BY rank');
              $stmt->execute(array( ':em' =>$_GET['profile_id']));
              $subrow = $stmt->fetch(PDO::FETCH_ASSOC);
              $stmt2 = $pdo->prepare('SELECT name FROM Institution WHERE institution_id = :em');
              if($subrow !== false) {
                $stmt2->execute(array( ':em' =>$subrow['institution_id']));
                $subrow_school = $stmt2->fetch(PDO::FETCH_ASSOC);
                echo('<p>Education</p><ul>');
                echo('<li>'.$subrow['year'].': '.$subrow_school['name']);
                while($subrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $stmt2 = $pdo->prepare('SELECT name FROM Institution WHERE institution_id = :em');
                  $stmt2->execute(array( ':em' =>$subrow['institution_id']));
                  $subrow_school = $stmt2->fetch(PDO::FETCH_ASSOC);
                  echo('<li>'.$subrow['year'].': '.$subrow_school['name']);
                }
                echo('</ul>');
              }
              $stmt = $pdo->prepare('SELECT year, description FROM Position WHERE profile_id = :em ORDER BY rank');
              $stmt->execute(array( ':em' =>$_GET['profile_id']));
              $subrow = $stmt->fetch(PDO::FETCH_ASSOC);
              if($subrow !== false) {
                  echo('<p>Position</p><ul>');
                  echo('<li>'.$subrow['year'].': '.$subrow['description']);
                  while($subrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo('<li>'.$subrow['year'].': '.$subrow['description']);
                  }
                  echo('</ul>');
              }
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
