<?php
  session_start();
  require_once "pdo.php";
  if(isset($_POST['editpkm'])) {
    $sql = "UPDATE Pokemon SET name=:b, cp=:c, iv=:d, type=:f, parent=:e WHERE pokemon_id=:a";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':a' => $_GET['pokemon_id']+0,
      ':b' => $_POST['name'],
      ':c' => $_POST['cp']+0,
      ':d' => $_POST['iv']+0,
      ':e' => $_POST['parent']+0,
      ':f' => $_POST['type']
    ));
    header("location: index.php");
    $_SESSION['editpokemonmsgsuccess'] = 'Succesfully edited '.htmlentities($_POST['name']).'!';
    return;
  }
  if(isset($_POST['editnumber'])) {
    $_GET['pokemon_id'] += 0;
    $search = $pdo->query('SELECT name FROM Pokemon WHERE pokemon_id='.htmlentities($_GET['pokemon_id']).' LIMIT 1');
    $valuefound = $search->fetch(PDO::FETCH_ASSOC);
    $sql = "UPDATE Pokemon SET pokemon_id=:a WHERE name=:b";
    $stmt = $pdo->prepare($sql);
    $pokemon_idchecked = ($_POST['pokemon_id']+0 < 1) ? htmlentities($_GET['pokemon_id']) : $_POST['pokemon_id']+0;
    $stmt->execute(array(
      ':a' => $pokemon_idchecked,
      ':b' => $valuefound['name'],
    ));
    header("location: index.php");
    $_SESSION['editpokemonmsgsuccess'] = 'Succesfully edited '.htmlentities($_POST['name']).' Pokédex #!';
    return;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit a Pokémon in your Pokédex</title>
</head>
<body style="font-family:sans-serif">
  <p>Edit a Pokémon</p>
  <br>
  <table>
    <form method="post">
      <tr><td><label for="ID">Pokédex #
      <td><input type="text" size="40" name="pokemon_id" required></tr>
      <tr><td><input type="submit" name="editnumber" value="Edit Pokédex Number"></tr><tr><td><br></td></tr>
    </form>
    <form method="post">
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
      <tr><td><input type="submit" name="editpkm" value="Edit Pokémon Stats">
      <td><a href="index.php">Cancel</a></tr>
    </form>
  </table>
</body>
</html>
