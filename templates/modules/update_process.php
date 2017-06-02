<?php

function get_title(){
  return null;
}
function get_content(){
  return null;
}
function process_inputs(){
  if($_GET['action'] == 'income'){
      update_income_object($_GET['id'],$_POST['name'],$_POST['value'],$_POST['date'],$_POST['category']);
      redirect_to(home_url('result').'?i_u_a=1');
  }elseif($_GET['action'] == 'expense'){
      update_expense_object($_GET['id'],$_POST['name'],$_POST['value'],$_POST['date'],$_POST['category']);
      redirect_to(home_url('result').'?e_u_a=1');
  }else{
    die(add_message('خطای غیر منتظره!'));
  }
}
