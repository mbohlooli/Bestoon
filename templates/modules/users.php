<?php

function authentication_required() {
    return true;
}

function get_title(){
  return 'کاربران سیستم';
}

function get_content(){
  if(isset($_SESSION['user']) && $_SESSION['user'] == 'admin'){ ?>
    <table class="table table-hover table-bordered table-striped table-responsive">
      <tr>
        <th colspan="5" class="info">
          <div align="center">جدول دخل ها</div>
        </th>
      </tr>
      <tr class="warning">
          <th>ردیف</th>
          <th>نام کاربری</th>
          <th>نام</th>
          <th>نام خانوادگی</th>
  <?php    get_all_users();
  } else{
    echo '<div class="alert alert-danger" role="alert">تنها کاربر ارشد می تواند به این صفحه دسترسی داشته باشد.</div>';
  }
}
