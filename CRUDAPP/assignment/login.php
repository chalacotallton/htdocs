<?php
  session_start();
  require_once "pdo.php";
  if(isset($_POST['login'])){
    if(strlen($_POST['email']) <= 0 || strlen($_POST['pass']) <= 0) {
      $_SESSION['error'] = '<p style="color:red";>'.'User name and password are required'.'</p>';
      header('Location:login.php');
      return;
    }
  }
  if(isset($_POST['login'])) {
    $sql = "SELECT pass FROM access WHERE user=:user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user', $_POST['email']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (strlen(htmlentities($row['pass'])) > 0){
      if (htmlentities($_POST['pass'])==htmlentities($row['pass'])) {
      $_SESSION['name'] = htmlentities($_POST['email']);
      header('Location:index.php');
      return;
      }
      else {
        $_SESSION['error'] = '<p style="color:red";>'.'Incorrect password'.'</p>';
        header('Location:login.php');
        return;
      }
    }
    else {
        $_SESSION['error'] = '<p style="color:red";>'.'User not Found'.'</p>';
        header('Location:login.php');
        return;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tallton Chalaco Lacerda Santos - Automobile Tracker</title>
</head>
<body>
  <header>
  <h1>Please Log In</h1>
  <?php   if(isset($_SESSION['error'])) {
            echo($_SESSION['error']);
            unset($_SESSION['error']);
          }
  ?>
  </header>
  <main>
    <form method="post">
      <table>
        <tr><td>User Name</td>
            <td><input type="text" size="40" name="email"></td></tr>
        <tr><td>Password</td>
            <td><input type="password" size="40" name="pass"></td></tr>
        <tr><td><input type="submit" name="login" value="Log In"></td>
            <td><a href=index.php>Cancel</a></td></tr>
      </table>
  </main>
</body>
</html>
