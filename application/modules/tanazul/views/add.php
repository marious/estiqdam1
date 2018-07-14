<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Tanazul / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> Tanazul</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'seo_pages'; ?>">Tanazul</a>
                            </li>


                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> Tanazul</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="adv_text" class="control-label col-md-3">نص الاعلان</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'adv_text',
                                                        'class'         => 'form-control',
                                                        'id'            => 'adv_text',
                                                        'value'         => set_value('adv_text', $tanazul->adv_text),
                                                        'placeholder'   => '',
                                                    ];
                                                    ?>
                                                    <?= form_textarea($data); ?>
                                                    <?php echo form_error('adv_text'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="mobile_number" class="control-label col-md-3">رقم التواصل</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'mobile_number',
                                                        'class'         => 'form-control',
                                                        'id'            => 'mobile_number',
                                                        'value'         => set_value('mobile_number', $tanazul->mobile_number),
                                                        'placeholder'   => '',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('mobile_number'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->


                                            <div class="box-footer">
                                                <div class="col-md-6 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                                </div>
                                            </div>


                                        </fieldset>
                                        <!--                                   </div>-->
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div>
    </div>
</section>