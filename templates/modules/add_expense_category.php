<?php

  function get_title(){
      return 'ثبت دسته جدید';
  }function get_content(){
    return;
  }
  function process_inputs(){
      if(isset($_POST['expense_category'])){
          add_expense_category($_POST['expense_category']);
          redirect_to(home_url());
      } else{
        return;
      }
  }
