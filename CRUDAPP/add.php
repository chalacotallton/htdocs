<?php
  session_start();
  require_once "pdo.php";
  if(isset($_POST['pokemon_id'])) {
    $sql = "INSERT INTO Pokemon(pokemon_id, name, cp, iv, parent, type) VALUES(:a, :b, :c, :d, :e, :f)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':a' => $_POST['pokemon_id']+0,
      ':b' => $_POST['name'],
      ':c' => $_POST['cp']+0,
      ':d' => $_POST['iv']+0,
      ':e' => $_POST['parent']+0,
      ':f' => $_POST['type']
    ));
    header("location: index.php");
    $_SESSION['addpokemonmsgsuccess'] = "Succesfully added a new Pokémon into your Pokédex!";
    return;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add a new Pokémon to your Pokédex</title>
</head>
<body style="font-family:sans-serif">
  <p>Add a New Pokémon</p>
  <br><form method="post">
    <table>
      <tr><td><label for="ID">Pokédex #
      <td><input type="text" size="40" name="pokemon_id" required></tr>
      <tr><td><label for="name">Name:
      <td><input type="text" size="40" name="name" required></tr>
      <tr><td><label for="CP">CP:
      <td><input type="text" size="40" name="cp" required></tr>
      <tr><td><label for="iv">IV:
      <td><input type="text" size="40" name="iv" required></tr>
      <tr><td><label for="type">Type:
      <td><input type="text" size="40" name="type" required></tr>
      <tr><td><label for="evolution">Evolution Pokédex #
      <td><input type="text" size="40" name="parent" value="if none, left blank"></tr>
      <td><input type="submit" name="addpkm" value="Add Pokémon">
      <td><a href="index.php">Cancel</a></tr>
    </table>
  </form>
</body>
</html>
