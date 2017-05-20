<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      $a= incomes_count();
      $b = expenses_count();

      if(!$a && !$b){
        echo '<div class="alert alert-info" role="alert">هنوز دخل و خرجی ثبت نشده است.</div>';
      }else{
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array(
        array("y" => get_normal_income(), "label" => "متوسط درآمد ماهانه"),
        array("y" => get_normal_expense(), "label" => "متوسط خرج ماهانه"),
        array("y" => get_normal_income() - get_normal_expense(), "label" => "پس انداز ماهانه"),
      );
    ?>
    <script type="text/javascript">

        $(function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "theme1",
                animationEnabled: true,
                title: {
                    text: "میانگین"
                },
                data: [
                {
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }
                ]
            });
            chart.render();
        });
    </script>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php } ?>
    <a href="http://localhost/bestoon/chart5" class="btn btn-default" style="float: right !important;">مشاهده نمودار بعدی</a>
    <a href="http://localhost/bestoon/chart3" class="btn btn-default" style="float: left !important;">مشاهده نمودار قبلی</a>

<?php
    }
