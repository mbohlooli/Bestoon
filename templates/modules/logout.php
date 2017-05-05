<?php

function process_inputs() {
    user_logout();
    redirect_to(home_url('login'));
}
