<?php
  session_start();
  require_once "pdo.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit a Pokémon in your Pokédex</title>
</head>
<body style="font-family:sans-serif">
  <p>Edit a Pokémon</p>
  <br><form method="post">
    <table>
      <tr><td><label for="ID">Pokédex #
      <td><input type="text" size="40"></tr>
      <tr><td><label for="name">Name:
      <td><input type="text" size="40"></tr>
      <tr><td><label for="CP">CP:
      <td><input type="text" size="40"></tr>
      <tr><td><label for="iv">IV:
      <td><input type="text" size="40"></tr>
      <tr><td><label for="type">Type:
      <td><input type="text" size="40"></tr>
      <tr><td><label for="evolution">Evolution Pokédex #
      <td><input type="text" size="40"></tr>
      <td><input type="submit" name="addpkm" value="Confirm Edit">
      <td><a href="index.php">Cancel</a></tr>
    </table>
  </form>
</body>
</html>
