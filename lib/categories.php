<?php

// function get_all_income_categories(){
//     global $db;
//
//     $result = $db->query("
//       SELECT *
//       FROM income_categories
//     ");
//
//     return $result;
// }
//
// function get_income_category($name){
//     global $db;
//
//     $result = $db->query("
//       SELECT *
//       FROM income_categories
//       WHERE name = '$name'
//     ");
//
//     $row = $result->fetch_assoc();
//
//     return $row;
// }
//
// function income_category_exists($name = null) {
//     $row = get_income_category($name);
//     return isset($row['id']);
// }
//
// function add_income_category($name) {
//
//     if(!$name) {
//         return;
//     }
//
//     global $db;
//
//     if(!income_category_exists($name)) {
//         $db->query("
//             INSERT INTO income_categories (names) VALUES
//             ('$name');
//         ");
//
//     } else {
//         $db->query("
//             UPDATE income_categories
//             SET name = '$name',
//         ");
//
//     }
//
// }
//
// function delete_income_category($name){
//     global $db;
//
//     $db->query("
//       DELETE FROM income_categories
//       WHERE name = '$name'
//     ");
// }
//
// function initialize_income_categories(){
//     add_income_category('حقوق');
//     add_income_category('فروش');
//     add_income_category('یارانه');
//     add_income_category('اجاره');
//     add_income_category('بدهکار به من');
// }
// initialize_income_categories();
//
// function get_all_expesne_categories(){
//     global $db;
//
//     $result = $db->query("
//       SELECT *
//       FROM expense_categories
//     ");
//
//     return $result;
// }
//
// function add_expense_category($name){
//     global $db;
//
//     $db->query("
//       INSERT INTO expense_categories (name)VALUES
//       ('$name');
//     ");
// }
//
// function delete_expense_category($name){
//     global $db;
//
//     $db->query("
//       DELETE FROM expense_categories
//       WHERE name = '$name'
//     ");
// }
//
// function initialize_expense_categories(){
//     add_expense_category('خرید');
//     add_expense_category('اجاره');
//     add_expense_category('خودرو');
//     add_expense_category('رفت و آمد');
//     add_expense_category('غذا');
//     add_expense_category('قبوض');
//     add_expense_category('درمانی');
//     add_expense_category('سرگرمی');
//     add_expense_category('طلبکار از من');
// }
