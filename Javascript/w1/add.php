<?php
  session_start();
  require_once "pdo.php";
  if(!isset($_SESSION['name'])) {
    die('Not logged in');
  }
  if(isset($_POST['add'])) {
    function isemail() {
      for($i = 0; $i < strlen($_POST['email']); $i++) {
        if($_POST['email'][$i] === '@') {
          return true;
        }
      }
      return false;
    }
    function validatePos() {
      for($i=0; $i<9; $i++) {
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
      header('Location:add.php');
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
      header('Location:add.php');
      return;
    }
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1 ) {
      $_SESSION['error'] = '<p style=color:red>All fields are required</p>';
      header('Location:add.php');
      return;
    }
    elseif((isemail()) ? false : true) {
      $_SESSION['error'] = '<p style=color:red>Email address must contain @</p>';
      header('Location:add.php');
      return;
    }
    else {
      $stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');
      $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
         ':fn' => $_POST['first_name'],
         ':ln' => $_POST['last_name'],
         ':em' => $_POST['email'],
         ':he' => $_POST['headline'],
         ':su' => $_POST['summary'])
       );
      $profile_id = $pdo->lastInsertId();
      $rank = 0;
      for($i=0; $i<9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;

        $year = $_POST['year'.$i];
        $desc = $_POST['desc'.$i];
        $stmt = $pdo->prepare('INSERT INTO Position (profile_id, rank, year, description) VALUES ( :pid, :rank, :year, :desc)');
        $stmt->execute(array(
          ':pid' => $profile_id,
          ':rank' => $rank,
          ':year' => $year,
          ':desc' => $desc)
        );

      $rank++;

      }
      //add the education (missing institution_id parameter)
      $rank = 0;
      for($i=0; $i<9; $i++) {
        if ( ! isset($_POST['eduyear'.$i]) ) continue;
        if ( ! isset($_POST['edu_school'.$i]) ) continue;

        $year = $_POST['eduyear'.$i];
        $desc = $_POST['edu_school'.$i];
        $stmt = $pdo->prepare('INSERT INTO Education (profile_id, rank, year, institution_id) VALUES ( :pid, :rank, :year, :desc)');
        $stmt->execute(array(
          ':pid' => $profile_id,
          ':rank' => $rank,
          ':year' => $year,
          ':desc' => 1)
        );

      $rank++;

      }
      /*Successfully added to the database*/
      $_SESSION['error'] = '<p style=color:green>Profile added</p>';
      header('Location:index.php');
      return;
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once('head.php') ?>
  </head>
  <body>
    <header>
      <h1>Adding Profile for <?= htmlentities($_SESSION['name'])?></h1>
      <?php
        if(isset($_SESSION['error'])) {
          echo($_SESSION['error']);
        }
        unset($_SESSION['error']);
      ?>
    </header>
    <main>
      <form method="post">
        <table>
          <tr><td>First Name: </td><td><input type="text" size="70" name="first_name"></td></tr>
          <tr><td>Last Name: </td><td><input type="text" size="70" name="last_name"></td></tr>
          <tr><td>User Email: </td><td><input type="text" size="70" name="email"></td></tr>
          <tr><td>Headline: </td><td><input type="text" size="70" name="headline"></td></tr>
        </table>
        <p>Summary:<br/>
        <textarea name="summary" rows="12" cols="80"></textarea>
        </p>
        <p>
          <label for="addEdu">Education:</label>
          <input type="submit" id="addEdu" value="+">
        </p>
        <div id="Education_fields">
        </div>
        <p>
          <label for="addPos">Position:</label>
          <input type="submit" id="addPos" value="+">
        </p>

        <div id="position_fields">
        </div>
        <table>
          <tr><td><input type="submit" name="add" value="Add"></td>
          <td><input type="button" name="cancel" onclick="location.href='index.php'; return false;" value="Cancel"></td></tr>
        </table>
      </form>
    <script>
    //add position
    var  countPos = 0;
      $(document).ready(function(){
        window.console && console.log('Document ready called');
        $('#addPos').click(function() {
          event.preventDefault();
          window.console && console.log('plus signed clicked');
          if(countPos > 8) {
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
      var  countEdu = 0;
        $(document).ready(function(){
          window.console && console.log('Document ready called');
          $('#addEdu').click(function() {
            event.preventDefault();
            window.console && console.log('plus signed clicked');
            if(countEdu > 8) {
              alert("Maximum of nine position entries exceeded");
              window.console && console.log('countEdu: '+countEdu);
            }
            else {
              $('#Education_fields').append(
                '<div id="eduposition'+countEdu+'"> \
              <p>Year: <input type="text" name="eduyear'+countEdu+'" value="" /> \
              <input type="button" value="-" \
                  onclick="$(\'#eduposition'+countEdu+'\').remove();return false;"></p> \
                  <input type="text" size="80" name="edu_school'+countEdu+'" class="school" value=""> \
              </div>');
              window.console && console.log("appended into div");
              countEdu++;
              window.console && console.log('countEdu: '+countEdu);
            }
          })
        })
    </script>
    </main>
  </body>
</html>
