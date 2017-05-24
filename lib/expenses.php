<?php

function order_expenses($category){
  global $db;

  $res = $db->query("
    SELECT SUM(expense_value)
    FROM expenses
    WHERE expense_category = '$category'
  ");

  $result = $res->fetch_assoc();

  return $result['SUM(expense_value)'];
}

function get_normal_expense(){
  global $db;

  $result = $db->query("
      SELECT AVG(M)
      FROM(
        SELECT SUM(expense_value) as M
        FROM expenses
        GROUP BY expense_date
      ) as T;"
    );

    $row = $result->fetch_assoc();
    return $row['AVG(M)'];
}

function order_expenses_by_date(){

  global $db;

  $result = $db->query("
    SELECT AVG(expense_value), SUM(expense_value),COUNT(expense_date), expense_date
    FROM expenses
    GROUP BY expense_date;");
    return $result;
  /*$row = array();
  $i=0;

   while($res = $result->fetch_assoc()){

       $row[$i]['avg'] = $res['AVG(expense_value)'];
       $row[$i]['sum'] = $res['SUM(expense_value)'];
       $row[$i]['count'] = $res['COUNT(expense_date)'];

       $i++;

    }

    return($row);*/
}

function get_oldest_expense(){
  global $db;

  $date = $db->query("
    SELECT MIN(expense_date)
    FROM expenses
  ");

  $result = $date->fetch_assoc();

  return $result;
}

function get_latest_expense(){
  global $db;

  $date = $db->query("
    SELECT MAX(expense_date)
    FROM expenses
  ");

  $result = $date->fetch_assoc();

  return $result;
}

function get_expense_object_name($expense_object_name, $full_row = false){
  if(!$expense_object_name) {
      return null;
  }

  global $db;
  $result = $db->query("
      SELECT *
      FROM expenses
      WHERE expense_name = '$expense_object_name'
  ");

  $row = $result->fetch_assoc();
  if($row) {
      if($full_row) {
          return $row;
      } else {
          return $row['expense_name'];
      }
  } else {
      return null;
  }
}

function expenses_count() {
    global $db;
    $results = $db->query("
        SELECT *
        FROM expenses
    ");

    $counter = 0;
    while($row = $results->fetch_assoc()) {
        $counter++;
    }

    return $counter;
}

function get_expense_object_value($expense_object_name, $full_row = false) {

    if(!$expense_object_name) {
        return null;
    }

    global $db;
    $result = $db->query("
        SELECT *
        FROM expenses
        WHERE expense_name = '$expense_object_name'
    ");

    $row = $result->fetch_assoc();
    if($row) {
        if($full_row) {
            return $row;
        } else {
            return $row['expense_value'];
        }
    } else {
        return null;
    }
}

function expense_object_exists($expense_object_name = null) {
    $row = get_expense_object_name($expense_object_name, true);
    return isset($row['id']);
}

function add_expense_object($expense_object_name, $expense_object_value = null, $expense_object_date, $expense_object_category) {

    if(!$expense_object_name) {
        return;
    }

    $user = get_user(get_current_logged_in_user());
    $expense_object_user = $user['first_name'].' '.$user['last_name'];

    if(!$expense_object_value) {
        $expense_object_value = '0';
    }

    global $db;

    if(!expense_object_exists($expense_object_name)) {
        $db->query("
            INSERT INTO expenses (expense_name, expense_value, expense_date, expense_user, expense_category) VALUES
            ('$expense_object_name', '$expense_object_value', '$expense_object_date', '$expense_object_user', '$expense_object_category');
        ");

    } else {
        $db->query("
            UPDATE expenses
            SET expense_value = '$expense_object_value',
                expense_date = '$expense_object_date'
                WHERE expense_name = '$expense_object_name';
        ");

    }

}

function update_expense_object($expense_object_name, $expense_object_value = null) {
    add_expense_object($expense_object_name, $expense_object_value);
}

function get_all_expense_objects(){
  global $db;

  $row = $db->query("
    SELECT *
    FROM expenses
  ");
  $rows_count = expenses_count();
  for ($i=1; $i <= $rows_count; $i++) {
    $current = $row->fetch_assoc();
    $current['expense_name'] = prepare_input($current['expense_name']);
    $current['expense_value'] = prepare_input($current['expense_value']);
    $current['expense_date'] = prepare_input($current['expense_date']);
    $current['expense_category'] = prepare_input($current['expense_category']);
    echo "<tr> <td>$i</td> <td>$current[expense_name]</td> <td><div class='important'>$current[expense_value]</div></td> <td>$current[expense_category]</td> <td>$current[expense_user]</td> <td>$current[expense_date]</td> <td> <a href='#' class='btn btn-primary btn-xs' data-toggle='modal'>ویرایش</a> </td><td> <a href='http://localhost/bestoon/result?expense_del=$current[expense_name]&income_del=0'><button type='button' class='btn btn-danger btn-xs'>حذف</button></a> </td></tr>";
  }
}

function get_all_expense_objects_for_users(){
  global $db;

  $row = $db->query("
    SELECT *
    FROM expenses
  ");
  $rows_count = expenses_count();
  for ($i=1; $i <= $rows_count; $i++) {
    $current = $row->fetch_assoc();
    echo "<tr> <td>$i</td> <td>$current[expense_name]</td> <td><div class='important'>$current[expense_value]</div></td> <td>$current[expense_category]</td> <td>$current[expense_user]</td> <td>$current[expense_date]</td></tr>";
  }
}

function delete_expense_object($expense_object_name) {
    /*if(!expense_object_exists($expense_object_name)) {
        return;
    }*/

    global $db;
    $db->query("
        DELETE FROM expenses
        WHERE expense_name = '$expense_object_name';
    ");
}

function get_expenses_avarage(){
    global $db;
    $avg = $db->query("
      SELECT AVG(expense_value)
      FROM expenses
    ");
    $result = $avg->fetch_assoc();
    return $result;
}

function get_expenses_sum(){
    global $db;
    $sum = $db->query("
      SELECT SUM(expense_value)
      FROM expenses
    ");
    $result = $sum->fetch_assoc();
    return $result;
}
