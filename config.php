<?php

session_start();

define('DB_FILENAME', 'bestoon_db');

define('MYSQL_SERVER', 'localhost');

define('MYSQL_USERNAME', 'mehrab');

define('MYSQL_PASSWORD', '1234');

define('SITE_URL', 'http://localhost/bestoon/');

define('SITE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

define('APP_TITLE', 'بستون');

define('ADMIN_EMAIL', 'mehrab.bohlooli@outlook.com');

foreach(glob('lib/*.php') as $lib_file) {
    include_once($lib_file);
}


create_db_tables();
initialize_users();
initialize_income_categories();
initialize_expense_categories();
