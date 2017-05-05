<?php

function get_title(){
  return 'ثبت خرج جدید';
}

function get_content(){
  if(!is_user_loggen_in()){
    echo '<div class="alert alert-danger" role="alert">برای ثبت دخل باید وارد شوید.</div>';
  }elseif(!$_POST['income_name']){
    echo '<div class="alert alert-danger" role="alert">موضوع درآمد نمی تواند خالی باشد.</div>';
    return;
  }elseif(!$_POST['income_value']){
    echo '<div class="alert alert-danger" role="alert">میزان دخل نمی تواند خالی باشد.</div>';
    return;
  }elseif($_POST['income_value'] < 0){
    echo '<div class="alert alert-danger" role="alert">میزان دخل نمی تواند منفی باشد.</div>';
  }elseif(!$_POST['income_date']){
    echo '<div class="alert alert-danger" role="alert">تاریخ دخل نمی تواند خالی باشد</div>';
    return;
  }elseif (!is_numeric($_POST['income_value'])) {
    echo '<div class="alert alert-danger" role="alert">میزان  درآمد باید به صورت عددی و به تومان وارد شود.</div>';
  }else{
    add_income_object($_POST['income_name'], $_POST['income_value'], $_POST['income_date']);
    echo '<div class="alert alert-success" role="alert">درآمد شما با موققیّت ثبت شد.';
    echo '<p>برای مشاهده به  <a href="http://localhost/bestoon/result"> صفحه برآیند</a> مراجعه کنید."</p>';
    echo '</div>';
  }
}
