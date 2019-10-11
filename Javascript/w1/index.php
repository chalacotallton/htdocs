<?php
  session_start();
  require_once "pdo.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="w1.css">
  <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
  <title>TALLTON CHALACO LACERDA SANTOS ' Resume Registry </title>
</head>
<body>
  <header>
    <h1>CHALACO LACERDA'S Resume Registry</h1>
    <?php
      if(isset($_SESSION['error'])) {
        echo($_SESSION['error']);
      }
      unset($_SESSION['error']);
    ?>
  </header>
  <main>
    <?php
      if(isset($_SESSION['name'])) {
    ?>
      <div>
        <a href=logout.php>Logout</a>
      <br/><br/>
      </div>
      <!--add aqui a tabela-->
      <div>
          <?php
            $stmt = $pdo->query("SELECT user_id, first_name, last_name, headline, profile_id FROM Profile");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <table class="tableshow">
            <tr>
              <th>Name</th>
              <th>Headline</th>
              <th>Action</th>
            </tr>
          <?php
              echo "<tr><td>";
              echo("<a href=view.php?profile_id=".$row['profile_id'].">".
              (htmlentities($row['first_name'].' '.$row['last_name']))."</a>");
              echo "</td><td>";
              echo(htmlentities($row['headline']));
              echo "</td><td>";
              echo('<a href="edit.php?user_id='.$row['user_id'].'">Edit</a>'." / ".'<a href="delete.php?user_id='.$row['user_id'].'">Delete</a>');
              echo "</td></tr>\n";
            }
          ?>
        </table>
      </div>
      <!--add aqui a tabela-->
      <br/>
      <a href=add.php>Add New Entry</a>
    <?php  }
      else {
    ?>
    <div>
      <a href=login.php>Please log in</a>
    </div>
    <div>
      <?php
        $stmt = $pdo->query("SELECT user_id, first_name, last_name, headline, profile_id FROM Profile");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <table class="tableshow">
        <tr>
          <th>Name</th>
          <th>Headline</th>
        </tr>
      <?php
          echo "<tr><td>";
          echo("<a href=view.php?profile_id=".$row['profile_id'].">".
          (htmlentities($row['first_name'].' '.$row['last_name']))."</a>");
          echo "</td><td>";
          echo(htmlentities($row['headline']));
          echo "</td><tr>\n";
        }
      ?>
    </table>
    </div>
    <?php
      }
    ?>
  </main>
</body>
</html>
