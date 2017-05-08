<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      /*if(!isset($_GET['income_amount']) || !isset($_GET['expense_amount'])){
        die('برای مشاهده نمودار ابتدا از صفحه <a href="http://localhost/bestoon/result"> برآیند </a> بازدید کنید!');
      }*/
      $income_sum = get_incomes_sum();
      $expense_sum = get_expenses_sum();
      $income_amount = $income_sum['SUM(income_value)'];
      $expense_amount = $expense_sum['SUM(expense_value)'];
      $result = $income_amount - $expense_amount;
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array(
          array("y" => $income_amount, "label" => "دخل"),
          array("y" => $expense_amount, "label" => "خرج"),
          array("y" => $result, "label" => "موجودی"),
      );
    ?>
    <script type="text/javascript">

        $(function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "theme1",
                animationEnabled: true,
                title: {
                    text: "نمودار دخل ها و خرج  ها"
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
    <?php }
