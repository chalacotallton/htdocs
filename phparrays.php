<head>
  <title> my first php array file </title>
</head>
<body>
  <p>
    This is the first paragraph of my php array file. Although I have already written .htm files back in 2009, this is the first time I write a .php file.
  </p>
  <?php
    echo 'this is my first array written inside a php tag';
    echo 'I\'ll be back';
    $thing = FALSE;
    print_r($thing);
    echo "two\n";
    var_dump($thing);
    $stuff = array("name" => "Chalaco",
                    "course" => "WA4E-coursera");
                    echo("<pre>\n");
    print_r($stuff);
    echo("\n</pre>\n");
  ?>
  <p>
    Looping through an Array
  </p>
  <?php
    $za = array();
    $za["name"] = "Chalaco";
    $za["Course"] = "WA4E Coursera";
    foreach($za as $k => $v) {
      echo nl2br("Key= $k Val= $v \n");
    }
  ?>
  <p>
    <br>
  </p>
  <?php
    $za = array();
    $za[] = "Chalaco";
    $za[] = "WA4E Coursera";
    for($i=0; $i < count($za); ++$i) {
      echo nl2br("I= $i Val= $za[$i] \n");
    }
    $username = $za[0] ?? 'nobody';
    $username2 = $za['Chaslaco'] ?? 'nobody';
    echo ("$username $username2");
  ?>
  <ul>
    <li><a href="first.php" class="back"> &lArr;&hearts; o First Page</a></li>
    <li><a href="getarray.php?x=2&y=4" class="forward"> &rArr;&hearts;First php page (not actually)</a></li>
  </ul>
</body>
