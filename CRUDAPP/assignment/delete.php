<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name'])) {
    die('<p style="font-size:130%">'.'ACCESS DENIED'.'</p>');
  }
  if(isset($_GET['autos_id']) && is_numeric($_GET['autos_id'])) {
    $prtstmt = $pdo->prepare("SELECT make FROM autos WHERE autos_id=:id LIMIT 1");
    $prtstmt->execute(array(':id'=>$_GET['autos_id']));
    $row = $prtstmt->fetch(PDO::FETCH_ASSOC);
    if(strlen($row['make']) > 0) {
      $auto2del = htmlentities($row['make']);
      if (isset($_POST['delete'])) {
        $delstmt = $pdo->prepare("DELETE FROM autos WHERE autos_id = :auto2del");
        $delstmt->execute(array(
          ':auto2del' => $_GET['autos_id']
        ));
        $_SESSION['error'] = '<p style="color:green">'.'Record deleted'.'</p>';
        header("location: index.php");
        return;
      }
    }
    else {
      $_SESSION['error'] = '<p style="color:red">'.'Bad value for id'.'</p>';
      header("location: index.php");
      return;
    }
  }
  else {
    $_SESSION['error'] = '<p style="color:red">'.'Bad value for id'.'</p>';
    header("location: index.php");
    return;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tallton Chalaco Lacerda Santos - Automobile Tracker</title>
</head>
<body>
  <main>
    <p>Confirm: Deleting <?=$auto2del?></p>
    <form method="post">
      <input type="submit" name="delete" value="Delete"> <a href="index.php">Cancel</a>
  </main>
</body>
</html>
