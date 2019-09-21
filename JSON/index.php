<html>
<head>
  <title>Hello World</title>
  <script type="text/javascript" src="jquery.min.js">
  </script>
  <script type="text/javascript">
  $(document).ready(function() {
    $.getJSON('json.php', function(data) {
      $("#back").html(data.second);
      window.console && console.log(data)
    })
  }
  );
  </script>
</head>
<body>
  <p id="back">Let's get some json back</p>


</body>
</html>
