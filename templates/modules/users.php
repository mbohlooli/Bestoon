<?php

function authentication_required() {
    return true;
}

function get_title(){
  return 'کاربران سیستم';
}

function get_content(){
  if(isset($_SESSION['user']) && $_SESSION['user'] == 'admin'){
    if(is_user_loggen_in()){
      if(!isset($_GET['user_del'])){
        error_reporting(0);
      }

      if($_GET['user_del'] == 'admin'){
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>کاربر ادمین نمی توان حذف شود.</strong>
          </div>';
      }elseif($_GET['user_del']){
        $username = $_GET['user_del'];
        delete_user($username);
      }
    }
     ?>
    <table class="table table-hover table-bordered table-striped table-responsive">
      <tr>
        <th colspan="6" class="info">
          <div align="center">جدول دخل ها</div>
        </th>
      </tr>
      <tr class="warning">
          <th>ردیف</th>
          <th>نام کاربری</th>
          <th>نام</th>
          <th>نام خانوادگی</th>
          <th>ایمیل</th>
          <th>عملیات جانبی</th>
  <?php    get_all_users();
  } else{
    echo '<div class="alert alert-danger" role="alert">تنها کاربر ارشد می تواند به این صفحه دسترسی داشته باشد.</div>';
  }
}
