<?php

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

  $row = $result->fetchArray(SQLITE3_ASSOC);
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
    while($row = $results->fetchArray(SQLITE3_ASSOC)) {
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

    $row = $result->fetchArray(SQLITE3_ASSOC);
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

function add_expense_object($expense_object_name, $expense_object_value = null, $expense_object_date) {

    if(!$expense_object_name) {
        return;
    }

    $expense_user = get_current_logged_in_user();

    if(!$expense_object_value) {
        $expense_object_value = '0';
    }

    global $db;

    if(!expense_object_exists($expense_object_name)) {
        $db->query("
            INSERT INTO expenses (expense_name, expense_value, expense_date, expense_user) VALUES
            ('$expense_object_name', '$expense_object_value', '$expense_object_date', '$expense_user');
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
    $current = $row->fetchArray(SQLITE3_ASSOC);
    echo "<tr> <td>$i</td> <td>$current[expense_name]</td> <td><div class='important'>$current[expense_value]</div></td> <td>$current[expense_user]</td> <td>$current[expense_date]</td> <td> <a href='#' class='btn btn-primary btn-sm' data-toggle='modal'>ویرایش</a> <a href='http://localhost/bestoon/result?expense_del=$current[expense_name]&income_del=0'><button type='button' class='btn btn-danger btn-sm'>حذف</button></a> </td></tr>";
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
    $current = $row->fetchArray(SQLITE3_ASSOC);
    echo "<tr> <td>$i</td> <td>$current[expense_name]</td> <td><div class='important'>$current[expense_value]</div></td> <td>$current[expense_date]</td></tr>";
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
    $result = $avg->fetchArray(SQLITE3_ASSOC);
    return $result;
}

function get_expenses_sum(){
    global $db;
    $sum = $db->query("
      SELECT SUM(expense_value)
      FROM expenses
    ");
    $result = $sum->fetchArray(SQLITE3_ASSOC);
    return $result;
}
