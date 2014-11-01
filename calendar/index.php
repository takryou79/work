<?php

    if (isset($_POST['current_date'])) {
        $current_date = $_POST['current_date'];
    } else {
        $current_date = date('Y/m/d', strtotime('now'));
    }

?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <title>index.php</title>
  <link rel="stylesheet" href="css/common.css">
  <script src="/js/jquery.js"></script>
  <script>
  <!--
      $(document).ready(function(){

          $('#content :input[name="select_date"]').bind('click', function(){

              var current_date = encodeURI($('#content :input[name="current_date"]').val());
              var url = 'calendar.php?current_date=' + current_date;
              var name = 'calendar';

              var calendar = window.open(url, name, 'width=400, height=400, menubar=no, toolbar=no, scrollbars=yes');
              calendar.focus();

          });

      });
  -->
  </script>
  <style>
  <!--

    #content { 

    }

    #content form {
         width : 200px;
         height: 100px;
         border: 1px solid #cccccc;
    }


  //-->
  </style>
  </head>
  <body>
    <div id="content">
      <form name="form1" method="POST" action="index.php">
        <input type="text" name="current_date" value="<?php echo $current_date ?>">
        <input type="button" name="select_date" value="…">
        <br>
        <br>
        <input type="submit" value="送信">
      </form>
      <br>
      <br>
      <form name="form2" method="POST" action="index.php">
        edit from work
        <br>
        <br>
        <input type="submit" value="送信">
      </form>
    </div>
  </body>
</html>
