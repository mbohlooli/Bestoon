<?php

function user_count() {
    global $db;
    $results = $db->query("
        SELECT *
        FROM users
    ");

    $counter = 0;
    while($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $counter++;
    }

    return $counter;
}

function initialize_users() {
        global $db;
        if(!user_exists('admin')){
          $default_pw_hash = sha1('admin');
          $name = 'ادمین';
          $email = ADMIN_EMAIL;
          $db->query("
              INSERT INTO users (username, password, first_name, last_name, email) VALUES
              ('admin', '$default_pw_hash', '$name', '', '$email');
          ");
        }
}

function get_user($username) {
    if(!$username) {
        return null;
    }

    global $db;
    $result = $db->query("
        SELECT *
        FROM users
        WHERE username = '$username'
    ");

    $row = $result->fetchArray(SQLITE3_ASSOC);
    return $row;
}

function user_exists($username) {
    $user = get_user($username);
    return isset($user['id']);
}

function get_all_users(){
  global $db;

  $row = $db->query("
    SELECT *
    FROM users
  ");
  $rows_count = user_count();
  for ($i=1; $i <= $rows_count; $i++) {
    $current = $row->fetchArray(SQLITE3_ASSOC);
    if(!$current['last_name']){
      $current['last_name'] = 'نا مشخص';
    }
    if($current['username'] == 'admin'){
      echo "<tr> <td>$i</td> <td>$current[username]</td> <td>$current[first_name]</td> <td>$current[last_name]</td> <td style='font-size: 12pt;'>$current[email]</td> <td> <button type='button' class='btn btn-primary btn-sm' >ویرایش</button> </td> </tr>";
    }else{
      echo "<tr> <td>$i</td> <td>$current[username]</td> <td>$current[first_name]</td> <td>$current[last_name]</td> <td> <button type='button' class='btn btn-primary btn-sm' >ویرایش</button> <a href='http://localhost/bestoon/users?user_del=$current[username]'><button type='button' class='btn btn-danger btn-sm'>حذف</button></a> </td> </tr>";
    }
  }
}

function add_users($username, $password, $first_name, $last_name, $email) {

    /*if(!$userdata['username']) {
        return;
    }
    $username = $userdata['username'];*/

    $password = sha1($password);
    if(!$last_name){
      $last_name = null;
    }

    global $db;
    if(!user_exists($username)) {
        $db->query("
            INSERT INTO users (username, password, first_name, last_name, email) VALUES
            ('$username', '$password', '$first_name', '$last_name', '$email');
        ");

    } else {
        $db->query("
            UPDATE users
            SET password = '$password', first_name = '$first_name', last_name = '$last_name'
            WHERE username = '$username';
        ");

    }
}

function update_user($userdata) {
    add_users($userdata);
}

function delete_user($username) {
    if(!user_exists($username)) {
        return;
    }

    global $db;
    $db->query("
        DELETE FROM users
        WHERE username = '$username';
    ");
}
