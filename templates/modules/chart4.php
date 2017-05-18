<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      $b = order_expenses_by_date();
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array(
        array("y" => get_normal_income(), "label" => "متوسط درآمد ماهانه"),
        array("y" => get_normal_expense(), "label" => "متوسط خرج ماهانه"),
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
    <a href="http://localhost/bestoon/chart3" class="btn btn-default" style="float: left !important;">مشاهده نمودار قبلی</a>

<?php
    }
