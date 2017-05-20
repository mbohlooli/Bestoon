<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="font-size: 16px !important; padding-top: 10px;" href="<?php echo home_url(); ?>">
                <img id="logo" src="<?php echo SITE_URL; ?>includes/icons/logo.png" alt="<?php echo APP_TITLE; ?>">
            </a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
				<li><a href="<?php echo home_url(); ?>">صفحه اصلی <span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="#income_modal" data-toggle="modal">ثبت دخل جدید <span class="glyphicon glyphicon-usd"></span></a></li>
                <li><a href="#expense_modal" data-toggle="modal">ثبت خرج جدید <span class="glyphicon glyphicon-eur"></span></a></li>
                <li><a href="<?php echo home_url('result'); ?>?income_del=0&expense_del=0">صفحه برآیند <span class="glyphicon glyphicon-list-alt"></span></a></li>
                <li><a href="<?php echo home_url('chart'); ?>">نمودار <span class="glyphicon glyphicon-stats"></span></a></li>
                <li>
                  <?php
                  if(is_user_loggen_in() && get_current_logged_in_user() == 'admin'):
                        /*$_SESSION['access'] = 'admin';
                        session_write_close();*/
                  ?>
                      <a href="<?php echo home_url('users'); ?>" onclick="send_admin">کاربران</a>
                  <?php endif; ?>
                </li>
                <li>
                  <?php if(is_user_loggen_in() && get_current_logged_in_user() == 'admin'): ?>
                      <a href="<?php echo home_url('submit_user'); ?>">ثبت کاربر جدید</a>
                  <?php endif; ?>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if(is_user_loggen_in()): ?>
                <li>
                    <p class="navbar-text">
                    سلام
                    <?php
                      $current_user = get_current_user_data();
                      $name = get_user($current_user['username']);
                    ?>
                    <strong>&nbsp;<?php echo $name['first_name']; ?></strong>
                    </p>
                </li>
                <?php endif; ?>
                <li>
                    <?php if(is_user_loggen_in()): ?>
                        <a href="<?php echo home_url('logout'); ?>">خروج</a>
                    <?php else: ?>
                        <a href="<?php echo home_url('login'); ?>">ورود</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
