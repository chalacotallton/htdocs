
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <title>Hello World</title>

</head>
<body>
    <p>
      Hello <b><span id="person">Dear</span></b>.
      <form method="post">
        <label for="zz">
        <input type="text" name="inputbox">
        <input type="submit">
      </form>
      <input type="hidden" id = "zz" name="hiddeninput" value="<?= isset($_POST['inputbox']) ? $_POST['inputbox'] : "Dear" ?>">
      <script type="text/javascript">
      document.getElementById('person').innerHTML =   document.getElementById('zz').value;
      console.log(document.getElementById('zz').value);
      st = document.getElementById('person').innerHTML;
      window.console && console.log("ST = "+st);
      alert('Hi There ' + st);
      </script>
    </p>

</body>
</html>
