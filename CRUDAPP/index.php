<?php
  require_once "pdo.php";
  session_start();
    if(isset($_SESSION['addpokemonmsgsuccess'])) {
      echo('<p style="color:green">'.$_SESSION['addpokemonmsgsuccess'].'</p>');
      unset($_SESSION['addpokemonmsgsuccess']);
    }
    if(isset($_SESSION['deletepokemonmsgsuccess'])) {
      echo('<p style="color:red">'.$_SESSION['deletepokemonmsgsuccess'].'</p>');
      unset($_SESSION['deletepokemonmsgsuccess']);
    }
    if(isset($_SESSION['editpokemonmsgsuccess'])) {
      echo('<p style="color:green">'.$_SESSION['editpokemonmsgsuccess'].'</p>');
      unset($_SESSION['editpokemonmsgsuccess']);
    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Brand new Pokédex!</title>
  <style>
    body {
      font-family: sans-serif;
    }
    table, th, td {
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <h1>Your Pokédex</h1>
  <table style="width:100%">
    <tr>
      <th>Pokédex #</th>
      <th>Name</th>
      <th>CP</th>
      <th>IV</th>
      <th>Type</th>
      <th>Evolution</th>
      <th>Actions</th>
    </tr>
    <?php
      $stmt = $pdo->query("SELECT pokemon_id, name, cp, iv, parent, type FROM Pokemon");
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>";
        echo(htmlentities($row['pokemon_id']));
        echo "</td><td>";
        echo(htmlentities($row['name']));
        echo "</td><td>";
        echo(htmlentities($row['cp']));
        echo "</td><td>";
        echo(htmlentities($row['iv']));
        echo "</td><td>";
        echo(htmlentities($row['type']));
        echo "</td><td>";
        echo(htmlentities($row['parent']));
        echo "</td><td>";
        echo('<a href="edit.php?pokemon_id='.$row['pokemon_id'].'">Edit</a>'." / ".'<a href="delete.php?pokemon_id='.$row['pokemon_id'].'">Delete</a>');
        echo "</td></tr>\n";
      }
    ?>
  </table>
  <br>
  <a href="add.php">Add New Pokémon</a>
</body>
</html>
