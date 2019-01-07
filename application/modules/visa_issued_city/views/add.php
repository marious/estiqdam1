<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('visa_issued_city'); ?> / <?php echo (null == $id) ? lang('add_new') : lang('edit'); ?> </h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'visa_issued_city'; ?>"><?= lang('visa_issued_city'); ?></a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('visa_issued_city/add'); ?>"><?= lang('add_new'); ?></a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> <?= lang('visa_issued_city'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="city" class="control-label col-md-3"><?= lang('visa_issued_city'); ?></label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'city',
                                                        'class'         => 'form-control',
                                                        'id'            => 'city',
                                                        'value'         => set_value('city', $city->city),
                                                        'placeholder'   => lang('visa_issued_city'),
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('city'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->





                                            <div class="box-footer">
                                                <div class="col-md-6 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary btn-block"><?= lang('save'); ?></button>
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