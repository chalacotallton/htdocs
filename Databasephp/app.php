<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>A cool Application.</title>
</head>
<body style="font-family: sans-serif">
  <h1>There's a lot of cool stuff down here</h1>
<?php
  if(isset($_SESSION["success"])) {
    echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
    unset($_SESSION["success"]);
  }
  if (!isset($_SESSION["account"])) { ?>
    <p>Please <a href="login.php">Log in</a> to start.</p>
<?php }
  else { ?>
  <p>To access all the cool content you need to be loged in first.</p>
  <p>This is where a cool application would be.</p>
  <p> Please <a href="logout.php">Log Out</a> when you are done.</p>
<?php } ?>
</body>
</html>
