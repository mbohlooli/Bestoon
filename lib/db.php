<?php
global $db;
$db = new SQLite3(DB_FILENAME);
function create_db_tables() {
    global $db;
    $db->query("
        CREATE TABLE IF NOT EXISTS incomes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            income_name TEXT NOT NULL,
            income_value BIGINT NOT NULL,
            income_category TEXT NOT NULL,
            income_date DATE NOT NULL,
            income_user TEXT NOT NULL
        );
    ");
    $db->query("
        CREATE TABLE IF NOT EXISTS expenses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            expense_name TEXT NOT NULL,
            expense_value BIGINT NOT NULL,
            expense_category TEXT NOT NULL,
            expense_date DATE NOT NULL,
            expense_user TEXT NOT NULL
        );
   ");
   $db->query("
      CREATE TABLE IF NOT EXISTS users (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          username TEXT NOT NULL,
          password TEXT NOT NULL,
          first_name TEXT NOT NULL,
          last_name TEXT NOT NULL,
          email TEXT NOT NULL
      );
   ");
   $db->query("
      CREATE TABLE IF NOT EXISTS income_categories(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL
      );
   ");
   $db->query("
      CREATE TABLE IF NOT EXISTS expense_categories(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL
      );
   ");
}
