<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name'])) {
    die('Not logged in');
  }
  if(isset($_POST['edit'])) {
    function isemail() {
      for($i = 0; $i < strlen($_POST['email']); $i++) {
        if($_POST['email'][$i] === '@') {
          return true;
        }
      }
      return false;
    }
    function validatePos() {
      for($i=0; $i<=9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;

        $year = $_POST['year'.$i];
        $desc = $_POST['desc'.$i];

        if ( strlen($year) == 0 || strlen($desc) == 0 ) {
          return "<p style=color:red>All fields are required</p>";
        }

        if ( ! is_numeric($year) ) {
          return "<p style=color:red>Position year must be numeric</p>";
        }
      }
      return true;
    }
    if(validatePos() !== true) {
      $_SESSION['error'] = validatePos();
      header('Location:edit.php?profile_id='.htmlentities($_GET['profile_id']));
      return;
    }
    function validateEdu() {
      for($i=0; $i<9; $i++) {
        if ( ! isset($_POST['eduyear'.$i]) ) continue;
        if ( ! isset($_POST['edu_school'.$i]) ) continue;

        $year = $_POST['eduyear'.$i];
        $desc = $_POST['edu_school'.$i];

        if ( strlen($year) == 0 || strlen($desc) == 0 ) {
          return "<p style=color:red>All fields are required</p>";
        }

        if ( ! is_numeric($year) ) {
          return "<p style=color:red>Position year must be numeric</p>";
        }
      }
      return true;
    }
  /* validar a educação*/
    if(validateEdu() !== true) {
      $_SESSION['error'] = validateEdu();
      header('Location:edit.php?profile_id='.htmlentities($_GET['profile_id']));
      return;
    }
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1 ) {
      $_SESSION['error'] = '<p style=color:red>All fields are required</p>';
      header('Location:edit.php?profile_id='.htmlentities($_GET['profile_id']));
      return;
    }
    elseif((isemail()) ? false : true) {
      $_SESSION['error'] = '<p style=color:red>Email address must contain @</p>';
      header('Location:edit.php?profile_id='.htmlentities($_GET['profile_id']));
      return;
    }
    else {
      $stmt = $pdo->prepare('DELETE FROM Position WHERE profile_id=:pid');
      $stmt->execute(array( ':pid' => $_REQUEST['profile_id']));
    $sql = "UPDATE Profile SET first_name=:b, last_name=:c, email=:d, headline=:f, summary=:e WHERE profile_id=:a";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':a' => $_GET['profile_id'],
        ':b' => $_POST['first_name'],
        ':c' => $_POST['last_name'],
        ':d' => $_POST['email'],
        ':e' => $_POST['headline'],
        ':f' => $_POST['summary']
      ));
      $rank = 0;
      for($i=0; $i<=9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;

        $stmt = $pdo->prepare('INSERT INTO Position (profile_id, rank, year, description) VALUES ( :pid, :rank, :year, :desc)');
        $stmt->execute(array(
          ':pid' => $_GET['profile_id'],
          ':rank' => $rank,
          ':year' => $_POST['year'.$i],
          ':desc' => $_POST['desc'.$i])
        );

      $rank++;
      }
      $rank = 0;
      $stmt = $pdo->prepare('DELETE FROM education WHERE profile_id = :profile');
      $stmt->execute(array(
        ':profile' => $_GET['profile_id'])
      );
      for($i=0; $i<=9; $i++) {
        if ( ! isset($_POST['eduyear'.$i]) ) continue;
        if ( ! isset($_POST['edu_school'.$i]) ) continue;
        $stmt = $pdo->prepare('SELECT institution_id from Institution WHERE name = :institution LIMIT 1');
        $stmt->execute(array(
          ':institution' => $_POST['edu_school'.$i])
        );
        $institution = $stmt->fetch(PDO::FETCH_ASSOC);
       if (!empty($institution['institution_id'])) {
          $year = $_POST['eduyear'.$i];
          $stmt = $pdo->prepare('INSERT INTO Education (profile_id, rank, year, institution_id) VALUES ( :pid, :rank, :year, :institution)');
          $stmt->execute(array(
            ':pid' => $_GET['profile_id'],
            ':rank' => $rank,
            ':year' => $year,
            ':institution' => $institution['institution_id'])
          );
        }
        else {
          $stmt = $pdo->prepare('INSERT INTO Institution (name) VALUES ( :institution)');
          $stmt->execute(array(
            ':institution' => $_POST['edu_school'.$i])
          );
          $year = $_POST['eduyear'.$i];
          $stmt = $pdo->prepare('INSERT INTO Education (profile_id, rank, year, institution_id) VALUES ( :pid, :rank, :year, :institution)');
          $institution_id = $pdo->lastInsertId();
          $stmt->execute(array(
            ':pid' => $_GET['profile_id'],
            ':rank' => $rank,
            ':year' => $year,
            ':institution' => $institution_id)
          );
        }
        $rank++;
      }
      $_SESSION['error'] = '<p style="color:green">Profile updated</p>';
      header("location: index.php");
      return;
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TALLTON CHALACO LACERDA SANTOS - ADD</title>
    <link href="https://fonts.googleapis.com/css?family=Turret+Road&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="w1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <h1>Editing Profile for <?= htmlentities($_SESSION['name'])?></h1>
      <?php
        if(isset($_SESSION['error'])) {
          echo($_SESSION['error']);
        }
        unset($_SESSION['error']);
      ?>
    </header>
    <main>
      <?php
      $stmt = $pdo->prepare('SELECT first_name, last_name, email, headline, summary  FROM Profile WHERE profile_id = :em');
      $stmt->execute(array( ':em' => (is_numeric($_GET['profile_id'])) ? $_GET['profile_id'] : false));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false) {
          $_SESSION['error'] = '<p style=color:red>Could not load profile</p>';
          header('Location: index.php');
          return;
        }
        $stmt = $pdo->prepare('SELECT year, description  FROM Position WHERE profile_id = :em');
        $stmt->execute(array( ':em' => (is_numeric($_GET['profile_id'])) ? $_GET['profile_id'] : false));
        $stmt2 = $pdo->prepare('SELECT education.year, institution.name  FROM Education JOIN institution ON education.institution_id = institution.institution_id WHERE profile_id = :em ORDER BY education.rank');
        $stmt2->execute(array( ':em' => (is_numeric($_GET['profile_id'])) ? $_GET['profile_id'] : false));
      ?>
      <form method="post">
        <table>
          <tr><td>First Name: </td><td><input type="text" size="70" name="first_name" value="<?=htmlentities($row['first_name'])?>"></td></tr>
          <tr><td>Last Name: </td><td><input type="text" size="70" name="last_name" value="<?=htmlentities($row['last_name'])?>"></td></tr>
          <tr><td>User Email: </td><td><input type="text" size="70" name="email" value="<?=htmlentities($row['email'])?>"></td></tr>
          <tr><td>Headline: </td><td><input type="text" size="70" name="headline" value="<?=htmlentities($row['headline'])?>"></td></tr>
        </table>
        <p>Summary:<br/>
        <textarea name="summary" rows="12" cols="80"><?=htmlentities($row['summary'])?></textarea>
        </p>
        <p>
          <label for="addEdu">Education:</label>
          <input type="submit" id="addEdu" value="+">
        </p>
        <div id="Education_fields">
          <?php
          $countEdu = 1;
          while($subrow = $stmt2->fetch(PDO::FETCH_ASSOC)) {
          echo('<div id="eduposition'.$countEdu.'">');
          echo('<p>Year: <input type="text" name="eduyear'.$countEdu.'" value="'.$subrow['year'].'" />');
          echo('<input type="button" value="-"');
          echo(' onclick="$(\'#eduposition'.$countEdu.'\').remove();return false;"></p>');
          echo('<input type="text" name="edu_school'.$countEdu.'" value="'.$subrow['name'].'"></div>
          ');
          $countEdu++;
          }
          ?>
        </div>
        <p>
          <label for="addPos">Position:</label>
          <input type="submit" id="addPos" value="+">
        </p>
        <div id="position_fields">
        <?php
        $countPos = 1;
        while($subrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo('<div id="position'.$countPos.'">');
        echo('<p>Year: <input type="text" name="year'.$countPos.'" value="'.$subrow['year'].'" />');
        echo('<input type="button" value="-"');
        echo(' onclick="$(\'#position'.$countPos.'\').remove();return false;"></p>');
        echo('<textarea name="desc'.$countPos.'" rows="8" cols="80">'.$subrow['description'].'</textarea></div>
        ');
        $countPos++;
        }
        ?>
        </div>
        <table>
          <tr><td><input type="submit" name="edit" value="Save"></td>
          <td><input type="button" name="cancel" onclick="location.href='index.php'; return false;" value="Cancel"></td></tr>
        </table>
      </form>
      <script>
      var countPos = <?=$countPos?>;
        $(document).ready(function(){
          window.console && console.log('Document ready called');
          $('#addPos').click(function() {
            event.preventDefault();
            window.console && console.log('plus signed clicked');
            if(countPos > 9) {
              alert("Maximum of nine position entries exceeded");
              window.console && console.log('CountPos: '+countPos);
            }
            else {
              $('#position_fields').append(
                '<div id="position'+countPos+'"> \
              <p>Year: <input type="text" name="year'+countPos+'" value="" /> \
              <input type="button" value="-" \
                  onclick="$(\'#position'+countPos+'\').remove();return false;"></p> \
              <textarea name="desc'+countPos+'" rows="8" cols="80"></textarea>\
              </div>');
              window.console && console.log("appended into div");
              countPos++;
              window.console && console.log('CountPos: '+countPos);
            }
          })
        })
        //add Education
        var  countEdu = <?=$countEdu?>;
          $(document).ready(function(){
            window.console && console.log('Document ready called');
            $('#addEdu').click(function() {
              event.preventDefault();
              window.console && console.log('plus signed clicked');
              if(countEdu > 9) {
                alert("Maximum of nine position entries exceeded");
                window.console && console.log('countEdu: '+countEdu);
              }
              else {
                $('#Education_fields').append(
                  '<div id="eduposition'+countEdu+'"> \
                <p>Year: <input type="text" name="eduyear'+countEdu+'" value="" /> \
                <input type="button" value="-" \
                    onclick="$(\'#eduposition'+countEdu+'\').remove();return false;"></p> \
                    <input type="text" size="80" name="edu_school'+countEdu+'" class="school" value="" /> \
                </div>');
                window.console && console.log("appended into div");
                countEdu++;
                window.console && console.log('countEdu: '+countEdu);
                $('.school').autocomplete({
                  source: "school.php"
                });
              }
            })
          })
      </script>
    </main>
  </body>
</html>
