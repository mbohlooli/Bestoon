<?php

function get_all_income_categories(){
    global $db;

    $row = $db->query("
      SELECT *
      FROM income_categories
    ");

    while($result = $row->fetch_assoc()){
      echo "<option>$result[name]</option>";
    }
}

function get_income_category($name){
    global $db;

    $result = $db->query("
      SELECT *
      FROM income_categories
      WHERE name = '$name'
    ");

    $row = $result->fetch_assoc();

    return $row;
}

function income_category_exists($name) {
    $row = get_income_category($name);
    return isset($row['id']);
}

function order_incomes_by_category(){
  global $db;

  $row = $db->query("
    SELECT *
    FROM income_categories
  ");

  return $row;
}

function order_expenses_by_category(){
  global $db;

  $row = $db->query("
    SELECT *
    FROM expense_categories
  ");

  return $row;
}

function income_categories_count(){
  global $db;
  $results = $db->query("
      SELECT *
      FROM income_categories
  ");

  $counter = 0;
  while($row = $results->fetch_assoc()) {
      $counter++;
  }

  return $counter;
}

function expense_categories_count(){
  global $db;
  $results = $db->query("
      SELECT *
      FROM expense_categories
  ");

  $counter = 0;
  while($row = $results->fetch_assoc()) {
      $counter++;
  }

  return $counter;
}


function get_expense_category($name){
    global $db;

    $result = $db->query("
      SELECT *
      FROM expense_categories
      WHERE name = '$name'
    ");

    $row = $result->fetch_assoc();

    return $row;
}


function expense_category_exists($name) {
    $row = get_expense_category($name);
    return isset($row['id']);
}

function delete_income_category($name){
    global $db;

    $db->query("
      DELETE FROM income_categories
      WHERE name = '$name'
    ");
}

function get_all_expesne_categories(){
    global $db;

    $row = $db->query("
      SELECT *
      FROM expense_categories
    ");

    while($result = $row->fetch_assoc()){
      echo "<option>$result[name]</option>";
    }
}

function delete_expense_category($name){
    global $db;

    $db->query("
      DELETE FROM expense_categories
      WHERE name = '$name'
    ");
}


function add_income_category($name) {

    if(!$name) {
        return;
    }

    if(income_category_exists($name)){
      return;
    }
    global $db;

        $db->query("
            INSERT INTO income_categories (name) VALUES
            ('$name');
        ");

}

function add_expense_category($name){
    global $db;

    if(!$name) {
        return;
    }

    if(expense_category_exists($name)){
      return;
    }

    $db->query("
      INSERT INTO expense_categories (name)VALUES
      ('$name');
    ");
}

function initialize_income_categories(){
    add_income_category('حقوق');
    add_income_category('فروش');
    add_income_category('یارانه');
    add_income_category('اجاره');
    add_income_category('بدهکار به من');
}

function initialize_expense_categories(){
    add_expense_category('خرید');
    add_expense_category('اجاره');
    add_expense_category('خودرو');
    add_expense_category('رفت و آمد');
    add_expense_category('غذا');
    add_expense_category('قبوض');
    add_expense_category('درمانی');
    add_expense_category('سرگرمی');
    add_expense_category('طلبکار از من');
}
