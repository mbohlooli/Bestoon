<?php

function get_title(){
    return 'صفحه برآیند ها';
}
function get_content(){
if(is_user_loggen_in()){
  if(!isset($_GET['income_del']) && !isset($_GET['expense_del'])){
    error_reporting(0);
  }

  if($_GET['income_del']){
    $income_name = $_GET['income_del'];
    delete_income_object($income_name);
  }
  if($_GET['expense_del']){
    $expense_name = $_GET['expense_del'];
    delete_expense_object($expense_name);
  }
}
?>

  <div class="row">
    <div class="col-lg-6 col-md-<?php if(!is_user_loggen_in()){ echo 6; }else{ echo 12; } ?> col-sm-12 col-xs-12" id="income_area" align="center">
      <?php
          $income_count = incomes_count();

            if(!$income_count):
              echo '<div class="alert alert-info" role="alert">';
              echo 'هنوز هیچ دخلی ثبت نشده است.';
              echo '</div>';
            else: ?>
              <table class="table table-bordered table-hover table-responsive">
                <tr>
                  <th colspan="8" class="info">
                    <div align="center">جدول دخل ها</div>
                  </th>
                </tr>
                <tr class="warning">
                    <th>ردیف</th>
                    <th>موضوع دخل</th>
                    <th>میزان دخل</th>
                    <th>دسته</th>
                    <th>توسط</th>
                    <th>تاریخ دخل</th>
                    <?php if(is_user_loggen_in()): ?>
                    <th colspan="2">عملیات جانبی</th>
                    <?php endif; ?>
                </tr>
                <?php
                  if(is_user_loggen_in()){
                    get_all_income_objects();
                  }else{
                    get_all_income_objects_for_users();
                  }
                ?>
                <tr>
                  <td colspan="1">جمع: </td>
                  <td colspan="7" class="success">
                    <div align="center">
                      <?php
                        $income_sum = get_incomes_sum();
                        echo $income_sum['SUM(income_value)'];
                      ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="1">میانگین: </td>
                  <td colspan="7" class="info">
                    <div align="center">
                      <?php
                        $income_avg = get_incomes_avarage();
                        echo $income_avg['AVG(income_value)'];
                      ?>
                    </div>
                  </td>
                </tr>
          </table>
          <?php /*income_endif*/endif; ?>
        </div>

        <div class="col-lg-6 col-md-<?php if(!is_user_loggen_in()){ echo 6; }else{ echo 12; } ?> col-sm-12 col-xs-12" id="expense_area" align="center">
              <?php
                    $expense_count = expenses_count();
                    if(!$expense_count):
                      echo '<div class="alert alert-info" role="alert">';
                      echo 'هنوز هیچ خرجی ثبت نشده است.';
                      echo '</div>';
                    else: ?>
                      <table class="table table-bordered table-hover table-responsive">
                        <tr>
                          <th colspan="8" class="info">
                            <div align="center">جدول خرج ها</div>
                          </th>
                        </tr>
                        <tr class="warning">
                            <th>ردیف</th>
                            <th>موضوع خرج</th>
                            <th>میزان خرج</th>
                            <th>دسته</th>
                            <th>توسط</th>
                            <th>تاریخ خرج</th>
                            <?php if(is_user_loggen_in()): ?>
                            <th colspan="2">عملیات جانبی</th>
                            <?php endif; ?>
                        </tr>
                        <?php
                          if(is_user_loggen_in()){
                            get_all_expense_objects();
                          }else{
                            get_all_expense_objects_for_users();
                          }
                        ?>
                        <tr>
                          <td colspan="1">جمع: </td>
                          <td colspan="7" class="success">
                            <div align="center">
                              <?php
                                $expense_sum = get_expenses_sum();
                                echo $expense_sum['SUM(expense_value)'];
                              ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="1">میانگین: </td>
                          <td colspan="7" class="info">
                            <div align="center">
                              <?php
                                $expense_avg = get_expenses_avarage();
                                echo $expense_avg['AVG(expense_value)'];
                              ?>
                            </div>
                          </td>
                        </tr>
                  </table>
                <?php /*expense_endif*/endif; ?>
            </div>
        </div>
        <div class="row">
        <?php
          if(!$expense_count && !$income_count):
          else:
        ?>
            <div class="panel panel-primary">
              <div class="panel-heading">
                  <h3 class="panel-title">برآیند <span class="glyphicon glyphicon-edit"></span></h3>
              </div>
              <div class="panel-body">
                <?php
                  if(!isset($expense_sum) || !$expense_sum){
                    $expense_sum = array(
                      'SUM(expense_value)' => 0
                    );
                  }
                  if(!isset($income_sum) || !$income_sum){
                    $income_sum = array(
                      'SUM(income_value)' => 0
                    );
                  }
                  $expense_value = $expense_sum['SUM(expense_value)'];
                  $income_value = $income_sum['SUM(income_value)'];
                  $result = $income_value - $expense_value;

                  echo "<table class='table table-bordered table-striped table-responsive'>";
                  echo "<tr>";
                  echo "<th colspan='3'>موجودی: </th>";
                  echo "<td><div class='important' align='center'>$result</div></td>";
                  echo "</tr>";
                      if(!isset($income_avg) || !$income_avg){
                        $income_avg = array(
                          'AVG(income_value)' => 0
                        );
                      }
                      if(!isset($expense_avg) || !$expense_avg){
                        $expense_avg = array(
                          'AVG(expense_value)' => 0
                        );
                      }
                  echo "</table>";
                ?>
                <a href="http://localhost/bestoon/chart"><button type="button" class="btn btn-info">مشاهده نمودار</button></a>
              </div>
            </div>
          <?php endif; ?>
        </div>
<?php

}
