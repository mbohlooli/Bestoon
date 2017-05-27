<?php


function order_incomes($category){
  global $db;

  $res = $db->query("
    SELECT SUM(income_value)
    FROM incomes
    WHERE income_category = '$category'
  ");

  $result = $res->fetch_assoc();

  return $result['SUM(income_value)'];
}

function get_normal_income(){
  global $db;

  $result = $db->query("
      SELECT AVG(M)
      FROM(
        SELECT SUM(income_value) as M
        FROM incomes
        GROUP BY income_date
      ) as T;"
    );

    $row = $result->fetch_assoc();
    return $row['AVG(M)'];
}

function order_incomes_by_date(){

  global $db;

  $result = $db->query("
    SELECT AVG(income_value), SUM(income_value), COUNT(income_date), income_date
    FROM incomes
    GROUP BY income_date;");
    return($result);
  // $row = array();
  // $i=0;
  //
  //  while($res = $result->fetch_assoc()){
  //
  //      $row[$i]['avg'] = $res['AVG(income_value)'];
  //      $row[$i]['sum'] = $res['SUM(income_value)'];
  //      $row[$i]['count'] = $res['COUNT(income_date)'];
  //
  //      $i++;
  //
  //   }
  //
  //   return($row);
}

function get_oldest_income(){
  global $db;

  $date = $db->query("
    SELECT MIN(income_date)
    FROM incomes
  ");

  $result = $date->fetch_assoc();

  return $result;
}

function get_latest_income(){
  global $db;

  $date = $db->query("
    SELECT MAX(income_date)
    FROM incomes
  ");

  $result = $date->fetch_assoc();

  return $result;
}

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

  $row = $result->fetch_assoc();
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
    while($row = $results->fetch_assoc()) {
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

    $row = $result->fetch_assoc();
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

function add_income_object($income_object_name, $income_object_value = null, $income_object_date, $income_object_category) {

    if(!$income_object_name) {
        return;
    }

    $user = get_user(get_current_logged_in_user());
    $income_object_user = $user['first_name'].' '.$user['last_name'];

    if(!$income_object_value) {
        $income_object_value = '0';
    }

    global $db;

    if(!income_object_exists($income_object_name)) {
        $db->query("
            INSERT INTO incomes (income_name, income_value, income_date, income_user, income_category) VALUES
            ('$income_object_name', '$income_object_value', '$income_object_date', '$income_object_user', '$income_object_category');
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

function update_income_object($id, $income_object_name, $income_object_value, $income_object_date, $income_object_category) {
    $income_object_user = $user['first_name'].' '.$user['last_name'];

    global $db;

    $db->query("
        UPDATE incomes
        SET income_name = '$income_object_name',
            income_value = '$income_object_value',
            income_date = '$income_object_date',
            income_user = '$income_user',,
            income_category = '$income_object_category'
        WHERE id = '$id'
    ");
}

function get_all_income_objects(){

  global $db;

  $row = $db->query("
    SELECT *
    FROM incomes
  ");
  $rows_count = incomes_count();
  for ($i=1; $i <= $rows_count; $i++) {
    $current = $row->fetch_assoc();
    $current['income_name'] = prepare_input($current['income_name']);
    $current['income_value'] = prepare_input($current['income_value']);
    $current['income_date'] = prepare_input($current['income_date']);
    $current['income_category'] = prepare_input($current['income_category']);
    echo "<tr> <td>$i</td> <td>$current[income_name]</td> <td><div class='important'>$current[income_value]</div></td> <td>$current[income_category]</td> <td>$current[income_user]</td> <td>$current[income_date]</td> <td><div align='center'> <a href='#income_edit_modal' class='btn btn-primary btn-xs' data-toggle='modal'>ویرایش</a> </div></td><td><div align='center'> <a href='http://localhost/bestoon/result?expense_del=0&income_del=$current[income_name]'><button type='button' class='btn btn-danger btn-xs'>حذف</button></a> </div></td></tr>";
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
    $current = $row->fetch_assoc();
    echo "<tr> <td>$i</td> <td>$current[income_name]</td> <td><div class='important'>$current[income_value]</div></td> <td>$current[income_category]</td> <td>$current[income_user]</td> <td>$current[income_date]</td></tr>";
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
    $result = $avg->fetch_assoc();
    return $result;
}

function get_incomes_sum(){
    global $db;
    $sum = $db->query("
      SELECT SUM(income_value)
      FROM incomes
    ");
    $result = $sum->fetch_assoc();
    return $result;
}
