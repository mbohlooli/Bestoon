<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php echo APP_TITLE; ?>
            </a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
				<li><a href="<?php echo home_url(); ?>">صفحه اصلی</a></li>
                <li><a href="#income_modal" data-toggle="modal">ثبت دخل جدید</a></li>
                <li><a href="#expense_modal" data-toggle="modal">ثبت خرج جدید</a></li>
                <li><a href="<?php echo home_url('result'); ?>?income_del=0&expense_del=0">صفحه برآیند</a></li>
                <li><a href="<?php echo home_url('chart'); ?>">نمودار</a></li>
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
                <li>
                  <?php if(!is_user_loggen_in()): ?>
                    <a href="<?php echo home_url('submit_user'); ?>">ثبت نام</a></li>
                  <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
