<?php
  session_start();
  require_once "pdo.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Tallton Chalaco Lacerda Santos - Automobile Tracker</title>
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
  <header>
  <h1>Welcome to the Automobiles Database</h1>
  <?php
  if(!isset($_SESSION['name'])) {
    echo('<p><a href=login.php>'.'Please log in'.'</a></p>');
    die('<p>Attempt to <a href="add.php">'.'add data'.'</a> without logging in</p>');
  }
  if(isset($_SESSION['error'])) {
    echo($_SESSION['error']);
    unset($_SESSION['error']);
  }
  ?>
  </header>
  <main>
      <?php
        $stmt = $pdo->query("SELECT autos_id, make, model, year, mileage FROM autos");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false) {
          echo('No rows found');
        }
        else {
          ?>
          <table style="width:100%">
            <thead><tr>
              <th>Make</th>
              <th>model</th>
              <th>year</th>
              <th>Mileage</th>
              <th>Action</th>
            </tr></thead>
            <?php

          do {
            echo "<tr><td>";
            echo(htmlentities($row['make']));
            echo "</td><td>";
            echo(htmlentities($row['model']));
            echo "</td><td>";
            echo(htmlentities($row['year']));
            echo "</td><td>";
            echo(htmlentities($row['mileage']));
            echo "</td><td>";
            echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a>'." / ".'<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
            echo "</td></tr>\n";
          } while($row = $stmt->fetch(PDO::FETCH_ASSOC));
        }
      ?>
    </table>
    <footer>
      <p><a href="add.php">Add New Entry</a></p>
      <p><a href="logout.php">Logout</a></p>
    </footer>
  </main>
</body>
</html>
