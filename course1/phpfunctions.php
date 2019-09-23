<head>
  <title> PHP Functions </title>
  <h1> What does my php has?</h1>
</head>
<body>
<?php
   function dd($val){ $val = $val * 2; return $val; } $val = 15;
   if (function_exists('dd')) {
     $dval = dd($val); echo "Value = $val Doubled = $dval";
  }
  else {
    echo "doesn't exist";
  }
?>
<ul>
  <li><a href="test1.htm" class="back"> &lArr;&hearts; o First Page</a></li>
  <li><a href="htmlforms.php" class="forward"> &rArr;&hearts;First php page (not actually)</a></li>
</ul>
</body>
<?php
  echo phpinfo();
 ?>
