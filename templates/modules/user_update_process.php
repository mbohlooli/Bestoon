<?php

function authentication_required(){
    return true;
}

function get_title(){
    return;
}

function get_content(){
    return;
}

function process_inputs(){

  $test = get_user_by_id($_GET['id']);
  $a = get_value('reset_pass', 0);

  if($test['username'] == 'admin'){
    $_POST['username'] = 'admin';
  }

  if(user_exists($_POST['username']) && $_POST['username'] == get_current_logged_in_user() && $test['username'] != 'admin'){
    add_message('نام کاربری نمی تواند تکراری باشد.', 'error');
    return;
  } elseif(isset($_POST['username'])) {
      $username = $_POST['username'];
  }

  if(isset($_POST['first_name'])) {
      $first_name = $_POST['first_name'];
  }
  if(isset($_POST['last_name'])) {
      $last_name = $_POST['last_name'];
  }
  if(isset($_POST['email'])) {
      $email = $_POST['email'];
  }
  if(empty($username)) {
      add_message('نام کاربری نمی تواند خالی باشد.', 'error');
      return;
  }

  if(!$email) {
      add_message('نشانی ایمیل نمی تواند خالی باشد.', 'error');
      return;
  }

  if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    add_message('ایمیل وارد شده معتبر نیست.', 'warning');
    return;
  }

  if(email_exists($email) && $email != $test['email']){
    add_message('این ایمیل قبلا استفاده شده است.', 'warning');
    return;
  }

  else{
    update_user($_GET['id'], $username, get_value('reset_pass', 0), $first_name, $last_name, $email);
    redirect_to(home_url('users'));
  }

}
