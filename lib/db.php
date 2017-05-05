<?php

global $db;
$db = new SQLite3(DB_FILENAME);

function create_db_tables() {
    global $db;

    $db->query("
        CREATE TABLE IF NOT EXISTS incomes (
            income_name TEXT NOT NULL,
            income_value BIGINT NOT NULL,
            income_date DATE NOT NULL
        );
    ");

    $db->query("
        CREATE TABLE IF NOT EXISTS expenses (
            expense_name TEXT NOT NULL,
            expense_value BIGINT NOT NULL,
            expense_date DATE NOT NULL
        );
   ");

   $db->query("
      CREATE TABLE IF NOT EXISTS users (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          username TEXT NOT NULL,
          password TEXT NOT NULL,
          first_name TEXT NOT NULL,
          last_name TEXT NOT NULL
      );
   ");
}
