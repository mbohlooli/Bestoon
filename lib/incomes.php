<?php

function get_income_object_name($income_object_name, $full_row = false){
  if(!$income_object_name) {
      return null;
  }

  global $db;
  $result = $db->query("
      SELECT *
      FROM incomes
      WHERE income_name = '$income_object_name'
  ");

  $row = $result->fetchArray(SQLITE3_ASSOC);
  if($row) {
      if($full_row) {
          return $row;
      } else {
          return $row['income_name'];
      }
  } else {
      return null;
  }
}

function incomes_count() {
    global $db;
    $results = $db->query("
        SELECT *
        FROM incomes
    ");

    $counter = 0;
    while($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $counter++;
    }

    return $counter;
}

function get_income_object_value($income_object_name, $full_row = false) {

    if(!$income_object_name) {
        return null;
    }

    global $db;
    $result = $db->query("
        SELECT *
        FROM incomes
        WHERE income_name = '$income_object_name'
    ");

    $row = $result->fetchArray(SQLITE3_ASSOC);
    if($row) {
        if($full_row) {
            return $row;
        } else {
            return $row['income_value'];
        }
    } else {
        return null;
    }
}

function income_object_exists($income_object_name = null) {
    $row = get_income_object_name($income_object_name, true);
    return isset($row['id']);
}

function add_income_object($income_object_name, $income_object_value = null, $income_object_date) {

    if(!$income_object_name) {
        return;
    }

    if(!$income_object_value) {
        $income_object_value = '0';
    }

    global $db;

    if(!income_object_exists($income_object_name)) {
        $db->query("
            INSERT INTO incomes (income_name, income_value, income_date) VALUES
            ('$income_object_name', '$income_object_value', '$income_object_date');
        ");

    } else {
        $db->query("
            UPDATE incomes
            SET income_value = '$income_object_value',
                income_date = '$income_object_date'
                WHERE income_name = '$income_object_name';
        ");

    }

}

function update_income_object($income_object_name, $income_object_value = null) {
    add_income_object($income_object_name, $income_object_value);
}

function get_all_income_objects(){
  global $db;

  $row = $db->query("
    SELECT *
    FROM incomes
  ");
  $rows_count = incomes_count();
  for ($i=1; $i <= $rows_count; $i++) {
    $current = $row->fetchArray(SQLITE3_ASSOC);
    $url = SITE_URL.'income_process';
    $file = fopen('modals2.php', 'w+');
    echo "<tr> <td>$i</td> <td>$current[income_name]</td> <td><div class='important'>$current[income_value]</div></td> <td>$current[income_date]</td> <td> <a href='#income_modal_$current[income_name]' class='btn btn-primary btn-sm' data-toggle='modal'>ویرایش</a> <a href='http://localhost/bestoon/result?income_del=$current[income_name]&expense_del=0'><button type='button' class='btn btn-danger btn-sm'>حذف</button></a> </td></tr>";
    $modal =  "<div id='income_modal_$current[income_name]' class='modal fade' tabindex='-1' role='dialog'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <h3 class='modal-title'>ویرایش دخل</h3>
                        </div>
                      <div class='modal-body'>
                        <form class='form-horizontal' method='post' action='$url'>
                              <div class='form-group'>
                                <label for='name' class='col-sm-2 control-label'>موضوع دخل</label>
                                <div class='col-sm-10'>
                                    <input style='display: none !important;' type='text' class='form-control' id='name' placeholder='موضوع درآمد' name='income_name' value='$current[income_name]'>
                                </div>
                                <p class='form-control-static'>$current[income_name]</p>
                            </div>
                            <div class='form-group'>
                              <label for='value' class='col-sm-2 control-label'>میزان دخل</label>
                              <div class='col-sm-10'>
                                  <input type='text' class='form-control' id='value' placeholder='میزان درآمد' name='income_value' value='$current[income_value]'>
                              </div>
                            </div>
                            <div class='form-group'>
                              <label for='value' class='col-sm-2 control-label'>تاریخ دخل</label>
                              <div class='col-sm-2'>
                                <a onclick='timeNow(income_date)' href='#'><button type='button' class='btn btn-primary'>الآن</button></a>
                              </div>
                              <div class='col-sm-8'>
                                    <input type='Month' class='form-control' id='income_date' placeholder='ماه دخل(به میلادی)' name='income_date' value='$current[income_date]'>
                              </div>
                            </div>
                            <div class='form-group'>
                              <div class='col-sm-offset-2 col-sm-10'>
                                <button type='submit' class='btn btn-success'>ثبت</button>
                              </div>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
            ";
            fwrite($file, $modal);
            fclose($file);
  }
}

function get_all_income_objects_for_users(){
  global $db;

  $row = $db->query("
    SELECT *
    FROM incomes
  ");
  $rows_count = incomes_count();
  for ($i=1; $i <= $rows_count; $i++) {
    $current = $row->fetchArray(SQLITE3_ASSOC);
    echo "<tr> <td>$i</td> <td>$current[income_name]</td> <td><div class='important'>$current[income_value]</div></td> <td>$current[income_date]</td></tr>";
  }
}

function delete_income_object($income_object_name) {
    /*if(!income_object_exists($income_object_name)) {
        return;
    }*/

    global $db;
    $db->query("
        DELETE FROM incomes
        WHERE income_name = '$income_object_name';
    ");
}

function get_incomes_avarage(){
    global $db;
    $avg = $db->query("
      SELECT AVG(income_value)
      FROM incomes
    ");
    $result = $avg->fetchArray(SQLITE3_ASSOC);
    return $result;
}

function get_incomes_sum(){
    global $db;
    $sum = $db->query("
      SELECT SUM(income_value)
      FROM incomes
    ");
    $result = $sum->fetchArray(SQLITE3_ASSOC);
    return $result;
}
