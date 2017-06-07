<?php

function authentication_required() {
    return true;
}

function get_title(){
  return 'ویرایش کاربران';
}

function get_content(){
      if(!isset($_GET['action']) || !isset($_GET['id']) || !$_GET['action'] || !$_GET['id']){
        die('<div class="alert alert-danger">خطای غیر منتظره!</div>');
      }
      if($_GET['action'] == 'user'){

          $user = get_user_by_id($_GET['id']);

          if(!$user){
              die("<div class='alert alert-danger'>خطای غیر منتظره!</div>");
          }

          $username = $user['username'];
          $first_name = $user['first_name'];
          $last_name = $user['last_name'];
          $email = $user['email'];
          } else{
            die('<div class="alert alert-danger">خطای غیر منتظره!</div>');
          }
      ?>

      <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">ویرایش کاربر</h3>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" method="post" action="<?php echo SITE_URL; ?>user_update_process?id=<?php echo $_GET['id']; ?>">
                  <div class="form-group">
                      <label for="username" class="col-sm-2 control-label">نام کاربری</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" <?php if($user['username'] == 'admin') {echo 'disabled';} ?> >
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">نام</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="last_name" class="col-sm-2 control-label">نام خانوادگی</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="<?php if($user['last_name']){ echo 'نام خانوادگی'; }?>" value="<?php echo $user['last_name']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">ایمیل</label>
                    <div class="col-sm-10">
                          <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="cheackbox">
                        <input type="checkbox" name="reset_pass" id="reset_pass" value="1">&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="reset_pass">ریست رمز عبور</label><br>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">ثبت</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>


<?php }
