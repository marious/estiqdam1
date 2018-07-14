<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">تسجيل الدخول</div>
                <?php  if($this->session->flashdata('error_message'))    : ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error_message'); ?></div>
                <?php endif; ?>
                <div class="panel-body my-panel">
                    <form class="form-horizontal" role="form" method="POST" action="<?= site_url('site_security/login_customer'); ?>">
                        <input type="hidden" name="_token" value="V7t4COT6sgbLPQvftAcR8Brki5sSWJJqJkbejO7g">

                        <div class="form-group">
                            <label for="customer_name" class="col-md-4 control-label">اسم المستخدم</label>

                            <div class="col-md-6">
                                <input id="customer_name" type="text" class="form-control" name="customer_name" value="" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">الرقم السرى</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> تذكرنى
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    الدخول
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
