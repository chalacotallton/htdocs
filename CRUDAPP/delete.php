<?php
  session_start();
  require_once "pdo.php";
  if (isset($_POST['pokemon_id'])) {
    $delstmt = $pdo->prepare("DELETE FROM Pokemon WHERE pokemon_id = :pokemon2del");
    $delstmt->execute(array("pokemon2del" => $_SESSION['pokemon2del']));
    $_SESSION['deletepokemonmsgsuccess'] = $_SESSION['pokemon2delname'].' was deleted from your Pokédex!';
    header("location: index.php");
    return;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Confirm Delete</title>
</head>
<body>
  <?php
  if(isset($_GET['pokemon_id'])) {
    $prtstmt = $pdo->prepare("SELECT name, pokemon_id FROM Pokemon WHERE pokemon_id=:id LIMIT 1");
    $prtstmt->execute(array(':id'=>$_GET['pokemon_id']));
    $row = $prtstmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['pokemon2del'] = htmlentities($row['pokemon_id']);
    $_SESSION['pokemon2delname'] = htmlentities($row['name']);
    if(strlen($row['name']) > 0) { ?>
      <p>Confirm Deleting: <?= $row['name']?></p>
      <form method="post">
        <input type="hidden" name="pokemon_id" value="<?= $row['pokemon_id']?>">
        <input type="submit" value="Delete" name="delete">
        <a href="index.php">Cancel</a>
      </form>
  <?php
    }
    else {
      echo ('<p style="color:red"> Error! No Pokemon found with Pokédex # '. htmlentities($_GET['pokemon_id']).'!</p>');
      echo ('Click <a href="index.php">Here</a> to go back');
    }
  }
  else  {
    echo ('<p style="color:red"> Error! Pokemon ID is missing!</p>');
    echo ('Click <a href="index.php">Here</a> to go back');
  }?>
</body>
</html>
