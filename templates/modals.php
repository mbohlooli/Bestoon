
<div id="income_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">ثبت دخل جدید</h3>
            </div>
          <div class="modal-body">
            <form class="form-horizontal" method="post" action="<?php echo SITE_URL; ?>income_process">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">موضوع دخل</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="موضوع درآمد" name="income_name">
                    </div>
                </div>
                <div class="form-group">
                  <label for="value" class="col-sm-2 control-label">میزان دخل</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="value" placeholder="میزان درآمد" name="income_value">
                  </div>
                </div>
                <div class="form-group">
                  <label for="form-control" class="col-sm-2 control-label">دسته بندی</label>
                  <div class="col-sm-3">
                    <a class="btn btn-warning" href="#add_income_category" data-toggle="modal">دسته جدید</a>
                  </div>
                  <div class="col-sm-7">
                    <select class="form-control" id="form-control" name="income_category">
                      <?php get_all_income_categories(); ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="income_date" class="col-sm-2 control-label">تاریخ دخل</label>
                  <div class="col-sm-2">
                    <a onclick="timeNow(income_date)" href="#"><button type="button" class="btn btn-primary">الآن</button></a>
                  </div>
                  <div class="col-sm-8">
                        <input type="Month" class="form-control" id="income_date" placeholder="ماه دخل(به میلادی)" name="income_date">
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
    </div>
</div>



<div id="expense_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ثبت خرج جدید</h4>
            </div>
          <div class="modal-body">
            <form class="form-horizontal" method="post" action="<?php echo SITE_URL; ?>expense_process">
                <div class="form-group">
                    <label for="name2" class="col-sm-2 control-label">موضوع خرج</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name2" placeholder="موضوع خرج" name="expense_name">
                    </div>
                </div>
                <div class="form-group">
                  <label for="value2" class="col-sm-2 control-label">میزان خرج</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="value2" placeholder="میزان خرج" name="expense_value">
                  </div>
                </div>
                <div class="form-group">
                  <label for="form-control2" class="col-sm-2 control-label">دسته بندی</label>
                  <div class="col-sm-3">
                    <a class="btn btn-warning" href="#add_expense_category" data-toggle="modal">دسته جدید</a>
                  </div>
                  <div class="col-sm-7">
                    <select class="form-control" id="form-control2" name="expense_category">
                      <?php get_all_expesne_categories(); ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="expense_date" class="col-sm-2 control-label">تاریخ خرج</label>
                  <div class="col-sm-2">
                    <a onclick="timeNow(expense_date)" href="#"><button type="button" class="btn btn-primary" > الآن</button></a>
                  </div>
                  <div class="col-sm-8">
                      <input type="Month" class="form-control" id="expense_date" placeholder="ماه خرج(به میلادی)" name="expense_date">
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
    </div>
</div>

<div id="add_income_category" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
              <form class="form-horizontal" action="<?php echo SITE_URL; ?>add_income_category" method="post">
                  <div class="form-group">
                    <label for="income_category_name" class="col-sm-2 control-label">نام دسته</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="income_category_name" name="income_category" placeholder="نام دسته جدید">
                    </div>
                  </div>
              </form>
          </div>
        </div>
    </div>
</div>

<div id="add_expense_category" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
              <form class="form-horizontal" action="<?php echo SITE_URL; ?>add_expense_category" method="post">
                  <div class="form-group">
                    <label for="expense_category_name" class="col-sm-2 control-label">نام دسته</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="expense_category_name" name="expense_category" placeholder="نام دسته جدید">
                    </div>
                  </div>
              </form>
          </div>
        </div>
    </div>
</div>
<script src="<?php echo SITE_URL; ?>lib/date.js"></script>
