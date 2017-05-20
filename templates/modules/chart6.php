<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      $a= order_expenses('خرید');
      $b = order_expenses('اجاره');
      $c = order_expenses('خودرو');
      $d = order_expenses('رفت و آمد');
      $e = order_expenses('غذا');
      $f = order_expenses('قبوض');
      $g = order_expenses('درمانی');
      $h = order_expenses('سرگرمی');
      $i = order_expenses('طلبکار از من');

      if(!$a && !$b && !$c && !$d && !$e && !$f && !$g && !$h && !$i){
        echo '<div class="alert alert-info" role="alert">هنوز خرجی ثبت نشده.</div>';
      }else{
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array();

      if($a){
          array_push($dataPoints, array("y" => $a, "label" => "خرید"));
      }
      if($b){
          array_push($dataPoints, array("y" => $b, "label" => "اجاره"));
      }
      if($c){
          array_push($dataPoints, array("y" => $c, "label" => "خودرو"));
      }
      if($d){
          array_push($dataPoints, array("y" => $d, "label" => "رفت و آمد"));
      }
      if($e){
          array_push($dataPoints, array("y" => $e, "label" => "غذا"));
      }
      if($f){
          array_push($dataPoints, array("y" => $f, "label" => "قبوض"));
      }
      if($g){
          array_push($dataPoints, array("y" => $g, "label" => "درمانی"));
      }
      if($h){
          array_push($dataPoints, array("y" => $h, "label" => "سرگرمی"));
      }
      if($i){
          array_push($dataPoints, array("y" => $i, "label" => "طلبکار از من"));
      }
    ?>
    <script type="text/javascript">

        $(function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "theme2",
                animationEnabled: true,
                title: {
                    text: "دسته بندی خرج ها"
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
    <a href="http://localhost/bestoon/chart5" class="btn btn-default" style="float: left !important;">مشاهده نمودار قبلی</a>

<?php
    }
