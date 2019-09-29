<?php
  session_start();
  $failure = false;
  $salt = 'XyZzy12*_';
  $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

  if ( isset($_POST['who']) && isset($_POST['pass']) ) {
      if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
          $failure = "Email and password are required";
      } else {
          $check = hash('md5', $salt.$_POST['pass']);
          $str_check = false;
          for($i = 1; $i < strlen($_POST['who']); $i++) {
            if($_POST['who'][$i] == '@') {
              $str_check = true;
            }
          }
          if(!$str_check) {

            echo('<p style="color:red">Email must have an at-sign (@) </p>');
          }

          else if ( $check == $stored_hash ) {
            $_SESSION['LOGIN'] = true;
            error_log("Login success ".$_POST['who']);
            header('Location:autos.php?name='.urlencode($_POST['who']));
              return;
          } else {
              error_log("Login fail ".$_POST['who']." $check");
              $failure = "Incorrect password";
          }
      }
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
  <h1>Please Log in</h1>
</header>
<main>
  <?php if($failure !== false) {
    echo('<p style="color:red"> Error! '.htmlentities($failure).'</p>');
        } ?>
  <form method="post">
    <table>
      <tr><td>User Email: </td><td><input type="text" name="who"></td></tr>
      <tr><td>Password: </td><td><input type="password" name="pass"></td></tr>
      <tr><td><input type="submit" name="submit" value="Log In"></td>
      <td><input type="button" name="cancel" onclick="location.href='index.php'; return false;" value="Cancel"></td></tr>
    </table>
  </form>
</main>
</body>
</html>
