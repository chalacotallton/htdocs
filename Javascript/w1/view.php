<?php
  session_start();
  require_once "pdo.php";
  print_r($_GET['profile_id']);
  /*agora fazer uma comparação no servidor php (alterando o if, o else já está certo) para ver se o id existe e mostrar a informação apenas dele.
  caso não exista redirecionar para o main*/
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
      if(isset($_SESSION['name'])) {
            $stmt = $pdo->query("SELECT user_id, first_name, last_name, headline, profile_id, email, summary FROM Profile");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

              echo('<p>First Name: '.htmlentities($row['first_name']).'</p>');
              echo('<p>Last Name: '.htmlentities($row['last_name']).'</p>');
              echo('<p>Email: '.htmlentities($row['email']).'</p>');
              echo('<p>Headline:</p><p>'.htmlentities($row['headline']).'</p>');
              echo('<p>Summary:</p><p>'.htmlentities($row['summary']).'</p>');
            }
      }
      else {
        $_SESSION['error'] = '<p style=color:red>Could not load profile</p>';
        header('Location: index.php');
        return;
      }
      ?>
  </main>
</body>
</html>
