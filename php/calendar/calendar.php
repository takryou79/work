<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <title>calendar.php</title>
  <link rel="stylesheet" href="css/common.css">
  <script src="/js/jquery.js"></script>
  <script>
  <!--
      $(document).ready(function(){


          $('#calendar th').bind('click', function(){
//alert('clicked!');
              var date = $(this).attr('date');
              if (('' == date) || (undefined == date)) {
                  return false;
              }

              location.href='calendar.php?current_date=' + date;

          });


          $('#calendar td').bind('click', function(){
//alert('clicked!');
              var date = $(this).attr('date');
//alert(date);
              if (('' == date) || (undefined == date)) {
                  return false;
              }
              var parent_form_name = window.opener.$('form').map(function(){
                 if ($(this).find(':input[name="select_date"]').length) {
                     return $(this).attr('name');
                 }
              }).get();
//alert(parent_form_name);
              var parent_form = window.opener.$('form[name="' + parent_form_name + '"]')

              parent_form.find(':input[name="current_date"]').val(date);
//              parent_form.attr('action', '');
              parent_form.submit();

              window.focus();
//              window.close();

          });

      });
  -->
  </script>
  <style>
  <!--

    #calendar {
        width; 100%
    }

    #calendar table {
        margin: 0 auto;
        width: 350px;
    }

    #calendar th {
        background-color: pink;
        text-align : center;
        width:  50px;
        height: 50px;
        cursor:pointer;
    }

    #calendar td {
        background-color: #fffacd;
        text-align : center;
        width:  50px;
        height: 50px;
        cursor:pointer;
    }

    #calendar .current {
        background-color: #cccccc;
    }

    #calendar .sat {
        color: #0000ff;
    }

    #calendar .sun {
        color: #ff0000;
    }

  //-->
  </style>
  </head>
  <body>
    <div id="contents">
      <div id="calendar">
<?php

    $current_date = urldecode($_GET['current_date']);

//echo '$current_date : ';
//echo  $current_date;
//echo '<br>';
//echo '<br>';

    $current_year = date('Y', strtotime($current_date));

//echo '$current_year : ';
//echo  $current_year;
//echo '<br>';
//echo '<br>';

    $current_month = date('m', strtotime($current_date));

//echo '$current_month : ';
//echo  $current_month;
//echo '<br>';
//echo '<br>';

    $current_day = date('j', strtotime($current_date));

//echo '$current_day : ';
//echo  $current_day;
//echo '<br>';
//echo '<br>';

    $last_day = date("t", mktime(0, 0, 0, $current_month, 1, $current_year));

//echo '$last_day : ';
//echo  $last_day;
//echo '<br>';
//echo '<br>';

    ## 0 => 'Sun' 6 => 'Sat'
    $first_day_week = date('w', mktime(0, 0, 0, $current_month, 1, $current_year));

//echo '$first_day_week : ';
//echo  $first_day_week;
//echo '<br>';
//echo '<br>';

    ## 0 => 'Sun' 6 => 'Sat'
    $last_day_week = date('w', mktime(0, 0, 0, $current_month, $last_day, $current_year));

//echo '$last_day_week : ';
//echo  $last_day_week;
//echo '<br>';
//echo '<br>';

    $prev_year = date('Y/m/d', mktime(0, 0, 0, $current_month, 1, ($current_year - 1)));

//echo '$prev_year : ';
//echo  $prev_year;
//echo '<br>';
//echo '<br>';

    $prev_month = date('Y/m/d', mktime(0, 0, 0, ($current_month - 1), 1, $current_year));

//echo '$prev_month : ';
//echo  $prev_month;
//echo '<br>';
//echo '<br>';

    $next_year = date('Y/m/d', mktime(0, 0, 0, $current_month, 1, ($current_year + 1)));

//echo '$next_year : ';
//echo  $next_year;
//echo '<br>';
//echo '<br>';

    $next_month = date('Y/m/d', mktime(0, 0, 0, ($current_month + 1), 1, $current_year));

//echo '$next_month : ';
//echo  $next_month;
//echo '<br>';
//echo '<br>';

    echo '        <table>' . PHP_EOL;

    echo '          <tr>' . PHP_EOL;
    ## 日付切り替え部分
    echo '            <th date="' . $prev_year . '">&lt;&lt;</th>' . PHP_EOL;
    echo '            <th date="' . $prev_month . '">&lt;</th>' . PHP_EOL;
    echo '            <th colspan="3">' . $current_year . '年' . $current_month . '月' . '</th>' . PHP_EOL;
    echo '            <th date="' . $next_month . '">&gt;</th>' . PHP_EOL;
    echo '            <th date="' . $next_year . '">&gt;&gt;</th>' . PHP_EOL;
    echo '          </tr>' . PHP_EOL;

    echo '          <tr>' . PHP_EOL;
    ## 日付がない部分（1日より前）
    for ($week=0; $week<$first_day_week; $week++) {
        echo '            <td></td>' . PHP_EOL;
    }
    ## 日付がある部分
    for ($day=1; $day<=$last_day; $day++) {
        $week = date('w', mktime(0, 0, 0, $current_month, $day, $current_year));
        switch ($week) {
            case 0 :
                $text = '<span class="sun">' . $day . '</span>';
                break;
            case 6 :
                $text = '<span class="sat">' . $day . '</span>';
                break;
            default :
                $text = $day;
                break;
        }
        if ($current_day == $day) {
            echo '            <td class="current" date="' . date('Y/m/d', mktime(0, 0, 0, $current_month, $day, $current_year)) .'">' . $text . '</td>' . PHP_EOL;
        } else {
            echo '            <td date="' . date('Y/m/d', mktime(0, 0, 0, $current_month, $day, $current_year)) .'">' . $text . '</td>' . PHP_EOL;
        }
        if (6 == $week) {
            echo '          </tr>' . PHP_EOL;
            echo '          <tr>' . PHP_EOL;
        }
    }
    ## 日付がない部分（月末日より後）
    for ($week=$last_day_week; $week<6; $week++) {
        echo '            <td></td>' . PHP_EOL;
    }
    echo '          </tr>' . PHP_EOL;
    echo '        </table>' . PHP_EOL;

?>
      </div>
    </div>
  </body>
</html>
