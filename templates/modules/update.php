<?php

function get_title(){
    return 'ویرایش';
}
function get_content(){

    if($_GET['action'] == 'income'){

        $object = get_income_object_by_id($_GET['id']);

        if(!$object){
            die("<div class='alert alert-danger'>خطای غیر منتظره!</div>");
        }

        $name = $object['income_name'];
        $value = $object['income_value'];
        $category = $object['income_category'];
        $date = $object['income_date'];



    }elseif($_GET['action'] == 'expense'){

        $object = get_expense_object_by_id($_GET['id']);

        $name = $object['expense_name'];
        $value = $object['expense_value'];
        $category = $object['expense_category'];
        $date = $object['expense_date'];


    }else{
        die('<div class="alert alert-danger">خطای غیر منتظره!</div>');
    }
    ?>

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">
          <?php
              if($_GET['action'] == 'income'){
                  echo 'ویرایش دخل';
              }else{
                echo 'ویرایش خرج';
              }
          ?>
        </h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" method="post" action="<?php echo SITE_URL; ?>update_process?action=<?php echo $_GET['action']; ?>&id=<?php echo $_GET['id']; ?>">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">
                  <?php
                     if($_GET['action'] == 'income'){
                        echo 'موضوع دخل';
                     } else{
                       echo 'موضوع خرج';
                     }
                  ?>
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="form-group">
              <label for="value" class="col-sm-2 control-label">
                <?php

                  if($_GET['action'] == 'income'){
                     echo 'میزان دخل';
                  } else{
                    echo 'میزان خرج';
                  }

                ?>
              </label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="value" name="value" value="<?php echo $value; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="form-control" class="col-sm-2 control-label">دسته بندی</label>
              <div class="col-sm-3">
                <a class="btn btn-warning" href="#add_<?php if($_GET['action'] == 'income'){
                  echo 'income';
                }else{
                  echo 'expense';
                } ?>_category" data-toggle="modal">دسته جدید</a>
              </div>
              <div class="col-sm-7">
                <select class="form-control" id="form-control" name="category">
                  <?php
                    if($_GET['action'] == 'income'){
                      $options = get_all_income_categories2();
                    }elseif($_GET['action'] == 'expense'){
                      $options = get_all_expense_categories2();
                    }

                      while($res = $options->fetch_assoc()){
                          if($category != $res['name']){
                            echo "<option>$res[name]</option>";
                          }else{
                              echo "<option selected>$res[name]</option>";
                          }
                      }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="date" class="col-sm-2 control-label">تاریخ </label>
              <div class="col-sm-2">
                <a onclick="timeNow(date)" href="#"><button type="button" class="btn btn-primary">الآن</button></a>
              </div>
              <div class="col-sm-8">
                    <input type="Month" class="form-control" id="date" name="date" value="<?php echo $date; ?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">ثبت</button>
              </div>
            </div>
        </form>
    </div>
</div>
<?php }
