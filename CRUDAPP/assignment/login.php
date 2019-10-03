<?php
  session_start();
  require_once "pdo.php";
  if(isset($_POST['login'])){
    if(strlen($_POST['name']) <= 0 || strlen($_POST['password']) <= 0) {
      $_SESSION['error'] = '<p style="color:red";>'.'User name and password are required'.'</p>';
      header('Location:login.php');
      return;
    }
  }
  if(isset($_POST['login'])) {
    $sql = "SELECT pass FROM access WHERE user=:user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user', $_POST['name']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (strlen(htmlentities($row['pass'])) > 0){
      if (htmlentities($_POST['password'])==htmlentities($row['pass'])) {
      $_SESSION['name'] = htmlentities($_POST['name']);
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
            <td><input type="text" size="40" name="name"></td></tr>
        <tr><td>Password</td>
            <td><input type="password" size="40" name="password"></td></tr>
        <tr><td><input type="submit" name="login" value="Log in"></td>
            <td><a href=index.php>Cancel</a></td></tr>
      </table>
  </main>
</body>
</html>
