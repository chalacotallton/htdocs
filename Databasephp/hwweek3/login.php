<?php
  session_start();
  $failure = false;
  $salt = 'XyZzy12*_';
  $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

  if ( isset($_POST['email']) && isset($_POST['pass']) ) {
      if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
          $_SESSION['error'] = "Email and password are required";
          header('Location: login.php');
          return;
      } else {
          $check = hash('md5', $salt.$_POST['pass']);
          $str_check = false;
          for($i = 1; $i < strlen($_POST['email']); $i++) {
            if($_POST['email'][$i] == '@') {
              $str_check = true;
            }
          }
          if(!$str_check) {
            $_SESSION['error'] = 'Email must have an at-sign (@)';
            header('Location: login.php');
            return;
          }
          else if ( $check == $stored_hash ) {
            $_SESSION['name'] = $_POST['email'];
            error_log("Login success ".$_POST['email']);
            header('Location:view.php');
              return;
          } else {
              error_log("Login fail ".$_POST['email']." $check");
              $_SESSION['error'] = "Incorrect password";
              header('Location: login.php');
              return;
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
  <?php if(isset($_SESSION['error'])) {
          echo('<p style="color:red">'.htmlentities($_SESSION['error']).'</p>');
          unset($_SESSION['error']);
        } ?>
  <form method="post">
    <table>
      <tr><td>User Email: </td><td><input type="text" name="email"></td></tr>
      <tr><td>Password: </td><td><input type="password" name="pass"></td></tr>
      <tr><td><input type="submit" name="submit" value="Log In"></td>
      <td><input type="button" name="cancel" onclick="location.href='logout.php'; return false;" value="Cancel"></td></tr>
    </table>
  </form>
</main>
</body>
</html>
