<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      $a= order_incomes('حقوق');
      $b = order_incomes('فروش');
      $c = order_incomes('یارانه');
      $d = order_incomes('اجاره');
      $e = order_incomes('بدهکاری به من');

      if(!$a && !$b && !$c && !$d && !$e){
        echo '<div class="alert alert-info" role="alert">هنوز دخلی ثبت نشده است.</div>';
      }else{
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array();

      if($a){
          array_push($dataPoints, array("y" => $a, "label" => "حقوق"));
      }
      if($b){
          array_push($dataPoints, array("y" => $b, "label" => "فروش"));
      }
      if($c){
          array_push($dataPoints, array("y" => $c, "label" => "یارانه"));
      }
      if($d){
          array_push($dataPoints, array("y" => $d, "label" => "اجاره"));
      }
      if($e){
          array_push($dataPoints, array("y" => $e, "label" => "بدهکاری به من"));
      }
    ?>
    <script type="text/javascript">

        $(function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "theme2",
                animationEnabled: true,
                title: {
                    text: "دسته بندی دخل ها"
                },
                data: [
                {
                    type: "pie",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }
                ]
            });
            chart.render();
        });
    </script>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php } ?>
    <a href="http://localhost/bestoon/chart6" class="btn btn-default" style="float: right !important;">مشاهده نمودار بعدی</a>
    <a href="http://localhost/bestoon/chart4" class="btn btn-default" style="float: left !important;">مشاهده نمودار قبلی</a>

<?php
    }
