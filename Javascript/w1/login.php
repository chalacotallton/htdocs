<?php
  session_start();
  require_once "pdo.php";
  if(isset($_POST['submit'])){
    $salt = 'XyZzy12*_';
    $check = hash('md5', $salt.$_POST['pass']);
    $stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
    $stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row !== false ) {
      $_SESSION['name'] = $row['name'];
      $_SESSION['user_id'] = $row['user_id'];
      header("Location: index.php");
      return;
    }
    else {
      $_SESSION['error'] = '<p style=color:red>Incorrect password</p>';
      header("Location: login.php");
      return;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>TALLTON CHALACO LACERDA SANTOS - Profile Database</title>
  <meta charset="UTF-8">
  <link type="text/css" rel="stylesheet" href="w1.css">
  <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
  <script>
  function doValidate() {
    console.log('Validating...');
    try {
      pw = document.getElementById('id_1723').value;
      em = document.getElementById('id_1722').value;
      console.log("Validating pw="+pw);
      console.log("Validating email="+em);
      var arr = em.split("");
      var i;
      var flag = true;
      for ( i = 0; i < arr.length; i++) {
          if(arr[i] == '@') {
            flag = false;
          }
      }
      if (pw == null || pw == "" || em == null || em == "") {
        alert("Both fields must be filled out");
        return false;
      }
      else if (flag) {
        alert("Invalid email address");
        return false;
      }
      return true;
    } catch(e) {
      return false;
    }
    return false;
  }
  </script>
</head>
<body>
<header>
  <h1>Please Log in</h1>
  <?php
    if(isset($_SESSION['error'])) {
      echo($_SESSION['error']);
    }
    unset($_SESSION['error']);
  ?>
</header>
<main>
  <form method="post">
    <table>
      <tr><td>User Email: </td><td><input type="text" name="email" id="id_1722"></td></tr>
      <tr><td>Password: </td><td><input type="password" name="pass" id="id_1723"></td></tr>
      <tr><td><input type="submit" name="submit" onclick="return doValidate();" value="Log In"></td>
      <td><input type="button" name="cancel" onclick="location.href='logout.php'; return false;" value="Cancel"></td></tr>
    </table>
  </form>
</main>
</body>
</html>
