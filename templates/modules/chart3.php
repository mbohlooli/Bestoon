<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      $a = order_expenses_by_date();

      $b = expenses_count();

      if(!$b){
        echo '<div class="alert alert-info" role="alert">هنوز خرجی ثبت نشده است</div>';
      }else{
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array();
      while( $res = $a->fetch_assoc() ){
        $date = $res['expense_date'][0].$res['expense_date'][1].$res['expense_date'][2].$res['expense_date'][3].$res['expense_date'][4].$res['expense_date'][5].$res['expense_date'][6];
        array_push($dataPoints,array("y" => $res['SUM(expense_value)'], "label" => $date));
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
    <?php } ?>
    <a href="http://localhost/bestoon/chart4" class="btn btn-default" style="float: right !important;"><span class=" glyphicon glyphicon-arrow-right"></span> مشاهده نمودار بعدی</a>
    <a href="http://localhost/bestoon/chart2" class="btn btn-default" style="float: left !important;">مشاهده نمودار قبلی <span class=" glyphicon glyphicon-arrow-left"></span></a>

<?php
    }
