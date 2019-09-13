<?php
require_once "pdo.php";
if(isset($_POST['email']) && isset($_POST['password'])) {
  echo("<p>Handling POST data...</p>\n");
  $e = $_POST['email'];
  $p = $_POST['password'];

  $sql = "SELECT name FROM users WHERE email = '$e' AND password = '$p'";
  echo "<p>$sql</p>\n";
  $stmt = $pdo->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  var_dump($row);
  echo "-->\n";
  if ($row === FALSE) {
    echo "<h1>login incorrect.</h1>\n";
  }
  else {
    echo "<p>Login success.</p>\n";
  }
}

if(isset($_POST['email2']) && isset($_POST['password2'])) {
  echo("<p>Handling POST data...</p>\n");
  $sql2 = "SELECT name FROM users WHERE email = :em AND password = :pw";
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute(array(':em' => $_POST['email2'],':pw' => hash('md5',$_POST['password2'])));
  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  if ($row2 === FALSE) {
    echo "<h1>login incorrect.</h1>\n";
  }
  else {
    echo "<p>Login success.</p>\n";
  }
}
?>
<html>
<p>Please Login</p>
<form method="post">
  <p>Email:<input type="email" name="email"></p>
  <p>Password:<input type="password" name="password"></p>
  <p><input type="submit" name="login" value="Login"> <a href="login1.php">Refresh</a></p>
</form>
<p>"--------"</p>
<p>Please Login</p>
<form method="post">
  <p>Email:<input type="email" name="email2"></p>
  <p>Password:<input type="password" name="password2"></p>
  <p><input type="submit" name="login" value="Login"> <a href="login1.php">Refresh</a></p>
</form>
</html>
