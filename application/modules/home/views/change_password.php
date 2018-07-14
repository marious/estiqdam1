<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> تغيير الرقم السرى</div>
                <?php  if($this->session->flashdata('error_message'))    : ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error_message'); ?></div>
                <?php endif; ?>
                <div class="panel-body my-panel">
                    <form class="form-horizontal" role="form" method="POST" action="<?= site_url('home/change_password'); ?>">

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">الرقم السرى الجديد</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <?= form_error('password'); ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="col-md-4 control-label">تأكيد الرقم السرى</label>

                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                                <?= form_error('confirm_password'); ?>

                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    حفظ
                                </button>

<!--                                <a class="btn btn-danger" href="http://buildingsite.dev/password/reset">-->
<!--                                    نسيت الرقم السرى؟-->
<!--                                </a>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
