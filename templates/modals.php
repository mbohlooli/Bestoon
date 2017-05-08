<?php if(is_user_loggen_in()): ?>
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
                  <label for="value" class="col-sm-2 control-label">تاریخ دخل</label>
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
<?php else: ?>
  <div id="income_modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">خطا</h3>
              </div>
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>برای ثبت دخل باید وارد شوید.</strong>
              </div>
            </div>
          </div>
      </div>
  </div>
<?php
  endif;

  if(is_user_loggen_in()):
?>
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
                    <label for="name" class="col-sm-2 control-label">موضوع خرج</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="موضوع خرج" name="expense_name">
                    </div>
                </div>
                <div class="form-group">
                  <label for="value" class="col-sm-2 control-label">میزان خرج</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="value" placeholder="میزان خرج" name="expense_value">
                  </div>
                </div>
                <div class="form-group">
                  <label for="value" class="col-sm-2 control-label">تاریخ خرج</label>
                  <div class="col-sm-2">
                    <a onclick="timeNow(expense_date)" href="#"><button type="button" class="btn btn-primary"> الآن</button></a>
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
<?php else: ?>
  <div id="expense_modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">خطا</h3>
              </div>
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>برای ثبت خرج باید وارد شوید.</strong>
              </div>
            </div>
          </div>
      </div>
  </div>
<?php endif; ?>
<script src="<?php echo SITE_URL; ?>lib/date.js"></script>
