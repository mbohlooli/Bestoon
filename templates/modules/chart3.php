<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      $b = order_expenses_by_date();
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array();
      while( $res = $b->fetchArray(SQLITE3_ASSOC) ){
        array_push($dataPoints,array("y" => $res['SUM(expense_value)'], "label" => $res['expense_date']));

      }
    ?>
    <script type="text/javascript">

        $(function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "theme1",
                animationEnabled: true,
                title: {
                    text: "نمودار خرج ها"
                },
                data: [
                {
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }
                ]
            });
            chart.render();
        });
    </script>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <a href="http://localhost/bestoon/chart3" class="btn btn-default">مشاهده نمودار بعدی</a>
    <a href="http://localhost/bestoon/chart2" class="btn btn-default" style="float: left !important;">مشاهده نمودار قبلی</a>

<?php
    }
