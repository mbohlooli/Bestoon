<?php

  function get_title(){
      return 'ثبت دسته جدید';
  }function get_content(){
    return;
  }
  function process_inputs(){
      if(isset($_POST['income_category'])){
          add_income_category($_POST['income_category']);
          redirect_to(home_url());
      } else{
        return;
      }
  }
