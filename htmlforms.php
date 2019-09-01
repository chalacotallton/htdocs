<head>
  <title> HTML forms </title>
  <h1> HTML forms</h1>
</head>
<body>
  <p> a simple form </p>
  <form>
    <p><label for="first input">  My First Input </label>
    <input type="text" name="first input" id="first input"/></p>
    <input type="submit"/>
  </form>
  <form method="post">
      <p><label for="post method"> Input post form</label>
      <input type="text" name="post method" size="40" id="postid"/></p>
      <input type="submit" value="kkkk"/>
  </form>
  <pre>
    $_POST;
    $_GET;
<?php
  print_r($_GET);
  print_r($_POST);
?>
  </pre>
  <ul>
    <li><a href="test1.htm" class="back"> &lArr;&hearts; o First Page</a></li>
    <li><a href="htmlinputtypes.php" class="forward"> &rArr;&hearts;First php page (not actually)</a></li>
  </ul>
</body>
