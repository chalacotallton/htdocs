<?php
  session_start();
  if(!isset($_SESSION['name'])) {
    die('Not logged in');
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
      <h1>Adding Profile for <?= $_SESSION['name']?></h1>
    </header>
    <main>
      <form method="post">
        <table>
          <tr><td>First Name: </td><td><input type="text" size="70" name="firstname"></td></tr>
          <tr><td>Last Name: </td><td><input type="text" size="70" name="lastname"></td></tr>
          <tr><td>User Email: </td><td><input type="text" size="70" name="email"></td></tr>
          <tr><td>Headline: </td><td><input type="text" size="70" name="headline"></td></tr>
        </table>
        <p>Sumary:<br/>
        <textarea name="name" rows="12" cols="80"></textarea>
        </p>
        <table>
          <tr><td><input type="submit" name="submit" value="Log In"></td>
          <td><input type="button" name="cancel" onclick="location.href='index.php'; return false;" value="Cancel"></td></tr>
        </table>
      </form>
    </main>
  </body>
</html>
