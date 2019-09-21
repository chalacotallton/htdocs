<html>
<head>
  <title>Hello World with jquery</title>
  <script type="text/javascript" src="jquery.min.js"></script>
</head>
<body>
  <form id="target">
    <input type="text" name="one" value="Hello there" style="vertical-align:middle;"/>
    <img id="spinner" src="spinner.gif" height="25" style="vertical-align: middle; display:none;">
  </form>
  <hr/>
  <div id="result"></div>
  <hr/>
  <script type="text/javascript">
    $('#target').change(function(event) {
      event.preventDefault();
      $('#spinner').show();
      var form = $('#target');
      var txt = form.find('input[name="one"]').val();
      window.console && console.log('Sending POST');
      $.post('autoecho.php', {'val': txt },
          function(data) {
            window.console && console.log(data);
            $('#result').empty().append(data);
            $('#spinner').hide();
          }
      ).error(function() {
        window.console && console.log('error');
      });
      return false;
    });
  </script>
  <form id="target2">
    <input type="text" id="times3" name="two" value="Hello darkness my old friend" style="vertical-align:middle;"/>
    <img id="spinner" src="spinner.gif" height="25" style="vertical-align: middle; display:none;">
  </form>
  <script type="text/javascript">
    $('#times3').on("click", function(event) {
      var form = $('#target2');
      console.log(form.find('input[name="two"]').val());
      if($(this).val() == 'Hello darkness my old friend') {
        $(this).val("");
      }
      console.log("well? we are waiting");
    });
  /*  data = {'one':'two', 'three': 4,
  'five' : [ 'six', 'seven' ],
  'eight' : { 'nine' : 10, 'ten' : 11  }
};
alert(data.eight.nine);*/
  </script>


</body>
</html>
