<?php
//this is the php instance. Below we can find the html instace.
class Pokemon {
  public $tipagem = false;
  function __construct() {
    echo("a new pokemon were chosen!");
  }
};
class fire extends Pokemon{
  function __construct() {
    echo("A wild Charmander appeared!");
  }
};
class water extends Pokemon{
  function __construct() {
    echo("A wild Squirtle appeared!");
  }
};
class grass extends Pokemon{
  function __construct() {
    echo("A wild Bulbasaur appeared!\n");
  }
  function attack() {
    $damage = 10;
    echo ("Bulbasaur used solar beam!\n");
  }
};

?>
<!DOCTYPE html>
<html>
<head>
    <title>This is a sample OO php file</title>
</head>
<body>
  <p>
      In this page I will explore the basics of OO in the php language.
  </p>
  <form method="post">
    <label for="inpname"> Escolha o tipo de animal </label>
    <select name="inpname" id="inpname" required>
      <option value="water">água</option>
      <option value="fire">fogo</option>
      <option value="grass">planta</option>
      <option selected>Escolha seu inicial</option></select>
    <input type="submit" name="dogets">
  </form>
  <?php
  if (isset($_POST['inpname'])) {
    if ($_POST['inpname'] === 'water') {
      $pokemon = new water();
    }
    if ($_POST['inpname'] === 'grass') {
      $pokemon = new grass();
      $pokemon->attack();
    }
    if ($_POST['inpname'] === 'fire') {
      $pokemon = new fire();
    }
  }

  print_r($_POST);
  ?>
</body>
</html>
