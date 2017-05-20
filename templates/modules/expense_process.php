<?php

function authentication_required() {
    return true;
}

function get_title(){
  return 'ثبت خرج جدید';
}

function get_content(){
  if(empty($_POST)){
    die('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>آدرس وارد شده، صحیح نیست.</div>');
  }
  if(!$_POST['expense_name']){
    echo '<div class="alert alert-danger" role="alert">موضوع خرج نمی تواند خالی باشد.</div>';
    return;
  }elseif(!$_POST['expense_value']){
    echo '<div class="alert alert-danger" role="alert">میزان خرج نمی تواند خالی باشد.</div>';
  }elseif($_POST['expense_value'] < 0){
    echo '<div class="alert alert-danger" role="alert">میزان خرج نمی تواند منفی باشد.</div>';
  }elseif(!$_POST['expense_date']){
    echo '<div class="alert alert-danger" role="alert">ماه خرج نمی تواند خالی باشد</div>';
  }elseif(!is_numeric($_POST['expense_value'])){
    echo '<div class="alert alert-danger" role="alert">میزان خرج باید به صورت عددی و به تومان وارد شود.</div>';
  } else{

    add_expense_object($_POST['expense_name'], $_POST['expense_value'], $_POST['expense_date'], $_POST['expense_category']);
    echo '<div class="alert alert-success" role="alert">خرج شما با موققیّت ثبت شد.';
    echo '<p> برای مشاهده به  <a href="http://localhost/bestoon/result"> صفحه برآیند</a> مراجعه کنید."</p>';
    echo '</div>';
  }
}
