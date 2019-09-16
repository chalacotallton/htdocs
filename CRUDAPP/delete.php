<?php
  session_start();
  require_once "pdo.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Confirm Delete</title>
</head>
<body>
  <p>Confirm Deleting: <?php echo($_GET['pokemon_id']); ?> </p>
    <form method="post">
      <label for="send">
      <input type="hidden" name="user_id" value="0">
      <input type="submit" value="Delete" name="delete">
      <a href="index.php">Cancel</a>
    </form>
</body>
</html>
