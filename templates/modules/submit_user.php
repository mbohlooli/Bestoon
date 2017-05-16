<?php

function authentication_required() {
    return true;
}

function get_title(){
  return 'ثبت نام';
}

function get_content(){ ?>
  <?php get_module_name() ?>
  <?php if(isset($_SESSION['user']) && $_SESSION['user'] == 'admin'){ ?>
  <div id="error_area"></div>
  <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">

      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">ثبت نام</h3>
          </div>
          <div class="panel-body">

              <form class="form-horizontal" method="post">
                  <div class="form-group">
                      <label for="username" class="col-sm-2 control-label">نام کاربری</label>
                      <div class="col-sm-10">
                        <?php
                        $username = '';
                        if(isset($_POST['username'])) {
                            $username = $_POST['username'];
                        }
                        ?>
                          <input type="text" class="form-control" id="username" name="username" placeholder="نام کاربری" value="<?php echo $username; ?>" onkeyup="submit_processes()">
                      </div>
                    </div>
                  <div class="form-group">
                      <label for="first_name" class="col-sm-2 control-label">نام</label>
                      <div class="col-sm-10">
                        <?php
                        $first_name = '';
                        if(isset($_POST['first_name'])) {
                            $first_name = $_POST['first_name'];
                        }
                        ?>
                          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="نام" value="<?php echo $first_name; ?>" onkeyup="submit_processes()">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="last_name" class="col-sm-2 control-label">نام خانوادگی</label>
                      <div class="col-sm-10">
                        <?php
                        $last_name = '';
                        if(isset($_POST['last_name'])) {
                            $last_name = $_POST['last_name'];
                        }
                        ?>
                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="نام خانوادگی" value="<?php echo $last_name; ?>" onkeyup="submit_processes()">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">ایمیل</label>
                      <div class="col-sm-10">
                        <?php
                        $email = '';
                        if(isset($_POST['email'])) {
                            $email = $_POST['email'];
                        }
                        ?>
                          <input type="text" class="form-control" id="email" name="email" placeholder="ایمیل" value="<?php echo $email; ?>" onkeyup="submit_processes()">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="repet_password" class="col-sm-2 control-label">رمز عبور</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور" onkeyup="submit_processes()">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">تکرار رمز عبور</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" id="repet_password" name="repet_password" placeholder="تکرار رمز عبور" onkeyup="submit_processes()">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="login" class="btn btn-success">ثبت</button>
                      </div>
                  </div>
              </form>

          </div>
      </div>

      </div>
      <div class="col-md-1"></div>
  </div>

  <!--<script>
    function submit_processes(){
      var xhr;
      if(window.XMLHttpRequest)
          xhr = new XMLHttpRequest()
      else //IE5,IE6
          xhr = new ActiveXobject('Microsoft.XMLHttp')

      xhr.onreadystatechange = function(){
          if(xhr.readyState==4 && xhr.status==200){
              document.getElementById('result').innerHTML = xhr.responseText;
          }
      }
      var username = document.getElementById('username').value
      var password = document.getElementById('password').value
      var first_name = document.getElementById('first_name').value
      var last_name = document.getElementById('last_name').value
      xhr.open("POST", "<?php /*echo SITE_URL; */?>/lib/submit_user.", true)
      xhr.send()
    }
  </script>-->
<?php }
    else{
      echo '<div class="alert alert-danger" role="alert">تنها کاربر ارشد می تواند به این صفحه دسترسی داشته باشد.</div>';
    }
}

function process_inputs() {

  if(!isset($_POST['login'])) {
      return;
  }
  if(user_exists($_POST['username'])){
    add_message('نام کاربری نمی تواند تکراری باشد.', 'error');
    return;
  }
  elseif(isset($_POST['username'])) {
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

  if(isset($_POST['password'])) {
      $password = $_POST['password'];
  }
  if(isset($_POST['repet_password'])) {
      $repet_password = $_POST['repet_password'];
  }

  if(empty($password)) {
      add_message('رمز عبور نمی تواند خالی باشد.', 'error');
      return;
  }
  if(strlen($password) < 8) {
      add_message('رمز عبور باید حداقل 8 کاراکتر باشد.', 'warning');
      return;
  }
  if(empty($repet_password)) {
      add_message('تکرار رمز عبور نمی تواند خالی باشد.', 'error');
      return;
  }
  if($repet_password != $password){
    add_message('تکرار رمز عبور اشتباه است.', 'error');
    return;
  }else{
    add_users($username, $password, $first_name, $last_name, $email);
  }

  if(!user_exists($username)) {
      add_message('عملیات ناموفق بود!', 'warning');
  } else {
      redirect_to(home_url('users'));
  }

}
