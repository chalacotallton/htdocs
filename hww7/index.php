<!DOCTYPE html>
<head>
  <title> Tallton Chalaco Lacerda Santos MD5</title>
</head>
<body style="font-family: sans-serif">
  <h1>MD5 cracker</h1>
  <p>
    This application takes an MD5 hash of a four digit pin and check all 10,000 possible four digit PINs to determine the PIN.
  </p>
<pre>Debug output:
<?php
$goodtext = "Not found";
$total_checks = 0;
if (isset($_GET['md5'])) {
  $time_pre = microtime(true);
  $md5 = $_GET['md5'];

  $show = 15;
  $flag = false;
  function checkeq($val1, $val2 ) {
    global $total_checks;++$total_checks;
    if ($val1 == $val2) {
          return true;
    }
    else {
      return false;
    }
  }

  for ($i=0; $i <= 9; $i++) {
    $ch1 = $i;
    for ($j=0; $j <= 9; $j++) {
      $ch2 = $j;
      for ($k=0; $k <= 9; $k++) {
        $ch3 = $k;
        for ($l=0; $l <= 9; $l++) {
          $ch4 = $l;
          $try = $ch1.$ch2.$ch3.$ch4;
          $check = hash('md5', $try);
          if (checkeq($check, $md5)) {
            $flag = true;
            $goodtext = $try;
            break;
          }
          if ($show > 0) {
            print "$check $try\n";
            --$show;
          }
        }
      }
      if ($show <= 0 and $flag) {
        break;
      }
    }
    if ($show <= 0 and $flag) {
      break;
    }
  }
  print "Total checks: $total_checks\n";
  $time_post = microtime(true);
  print "Elapsed time: ";
  print $time_post-$time_pre;
  print "\n";
}
?>
</pre>
<p>PIN: <?= htmlentities($goodtext); ?></p>
<form>
  <label for="md5"></label>
  <input type="text" name="md5" size="60"/>
  <input type="submit" value="Crack MD5"/>
</form>
<ul>
  <li><a href="index.php"> Reset this Page </a></li>
</ul>
<div>
  <br><br>
  <h3>Generate a MD5 PIN</h3>
  <form method="post">
      <p><label for="pin">Enter the 4-digit pin</label>
      <input type="text" name="pin" size="40" id="postid"/></p>
      <input type="submit" value="Generate"/>
  </form>
  <?php
    if (isset($_POST['pin'])) {
      echo 'The hash for ';
      echo $_POST['pin'];
      $var = $_POST['pin'];
      echo ' is ';
      print hash('md5', "$var");
    }

  ?>
</div>
</body>

</html>
