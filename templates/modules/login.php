<?php

function get_title() {
    return 'ورود به سیستم';
}

function get_content() { ?>

    <?php get_module_name() ?>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ورود به سیستم</h3>
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
                            <input class="form-control" id="username" name="username" placeholder="نام کاربری" value="<?php echo $username; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">رمز عبور</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="login" class="btn btn-primary">ورود</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        </div>
        <div class="col-md-2"></div>
    </div>

<?php }

function process_inputs() {

    if(!isset($_POST['login'])) {
        return;
    }

    if(isset($_POST['username'])) {
        $username = $_POST['username'];
    }

    if(empty($username)) {
        add_message('نام کاربری نمی تواند خالی باشد.', 'error');
        return;
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if(empty($password)) {
        add_message('رمز عبور نمی تواند خالی باشد.', 'error');
        return;
    }

    user_login($username, $password);

    if(!is_user_loggen_in()) {
        add_message('نام کاربری یا رمز عبور، اشتباه است.', 'error');
    }else {

        if(!isset($_SESSION)) { 
              session_start();
          }

        setcookie(session_name(), session_id(), time() + 3600);

        $_SESSION['user'] = $username;

        session_write_close();
        redirect_to(home_url());
    }

}
