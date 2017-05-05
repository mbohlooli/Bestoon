<?php

function render_page() {
    if(function_exists('process_inputs')) {
        process_inputs();
    }
    
    include_once('templates/header.php');
	include_once('templates/modals.php');
    
    show_messages();
    
    if(function_exists('get_content')) {
        get_content();
    }
    
    include_once('templates/footer.php');
}

function load_module() {
    $module = get_module_name();
    if(empty($module)) {
        $module = 'home';
    }
    
    if(is_user_loggen_in() && $module == 'login') {
        redirect_to(home_url());
    }
    
    $module_file = "templates/modules/$module.php";
    if(file_exists($module_file)) {
        require_once("templates/modules/$module.php");
        check_for_authentication_requirement();
        
    } else {
        add_message('آدرس وارد شده، صحیح نیست.', 'error');
        require_once("templates/modules/home.php");
        
    }
    
    render_page();
}

function is_authentication_required() {
    if(function_exists('authentication_required')) {
        return authentication_required();
    }
    return false;
}

function check_for_authentication_requirement() {
    if(is_authentication_required() && !is_user_loggen_in()) {
        $login_url = home_url('login');
        redirect_to($login_url);
    }
}

$messages = array();

function add_message($message = null, $type = 'error') {
    if(!$message) {
        return;
    }
    
    global $messages;
    $messages[] = array(
        'message' => $message,
        'type' => $type,
    );
}

function show_messages() {
    global $messages;
    if(empty($messages)) {
        return;
    }
    
    foreach($messages as $item) {
        $message = $item['message'];
        $type = $item['type'];
        if($type == 'error') {
            $type = 'danger';
        }
        ?>
        <div class="alert alert-<?php echo $type; ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $message; ?>
        </div>
        <?php
    }

}