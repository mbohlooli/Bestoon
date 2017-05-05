<?php

session_start();

define('DB_FILENAME', 'bestoon.db');

define('SITE_URL', 'http://localhost/bestoon/');

define('SITE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

define('APP_TITLE', 'برنامه اول من');

foreach(glob('lib/*.php') as $lib_file) {
    include_once($lib_file);
}

create_db_tables();
initialize_users();