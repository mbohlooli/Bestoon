<?php

function get_title(){
  return 'ثبت نام';
}

function get_content(){ ?>
  <?php get_module_name() ?>

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
                          <input type="text" class="form-control" id="username" name="username" placeholder="نام کاربری" value="<?php echo $username; ?>">
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
                          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="نام" value="<?php echo $first_name; ?>">
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
                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="نام خانوادگی" value="<?php echo $last_name; ?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="repet_password" class="col-sm-2 control-label">رمز عبور</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">تکرار رمز عبور</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" id="repet_password" name="repet_password" placeholder="تکرار رمز عبور">
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

<?php }

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

  if(empty($username)) {
      add_message('نام کاربری نمی تواند خالی باشد.', 'error');
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
    add_users($username, $password, $first_name, $last_name);
  }

  if(!user_exists($username)) {
      add_message('عملیات ناموفق بود!', 'warning');
  } else {
      redirect_to(home_url('login'));
  }

}
