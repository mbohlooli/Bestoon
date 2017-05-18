<?php

  function get_title(){
    return 'نمودار';
  }
    function get_content(){
      # print_r(order_incomes_by_date());

      $income_sum = get_incomes_sum();
      $expense_sum = get_expenses_sum();

      $income_avg = get_incomes_avarage();
      $expense_avg = get_expenses_avarage();

      $income_amount = $income_sum['SUM(income_value)'];
      $expense_amount = $expense_sum['SUM(expense_value)'];

      $income_amount2 = $income_avg['AVG(income_value)'];
      $expense_amount2 = $expense_avg['AVG(expense_value)'];

      $result = $income_amount - $expense_amount;

      if(!$result){
        echo '<div class="alert alert-info" role="alert">هنوز دخل و خرجی ثبت نشده است.</div>';
      }else{
?>
    <div id="chartContainer"></div>
    <?php
      $dataPoints = array(
          array("y" => $income_amount, "label" => "دخل"),
          array("y" => $expense_amount, "label" => "خرج"),
          array("y" => $result, "label" => "موجودی"),
          /*array("y" => $income_amount2, "label" => "میانگین دخل ها"),
          array("y" => $expense_amount2, "label" => "میانگین خرج ها"),*/
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
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php } ?>
    <a href="http://localhost/bestoon/chart2" class="btn btn-default">مشاهده نمودار بعدی</a>

<?php
}
