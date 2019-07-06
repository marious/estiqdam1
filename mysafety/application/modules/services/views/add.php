<div class="row">
    <div class="col-md-12">

        <?php if (validation_errors()): ?>
<!--            <div class="alert alert-danger alert-dismissible">-->
<!--                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
<!--                <h4><i class="icon fa fa-check"></i> Alert!</h4>-->
<!--                --><?php //echo validation_errors(); ?>
<!--            </div>-->
        <?php endif; ?>

        <form class="form-horizontal" action="<?= site_url('services/add/'.$id); ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
                    <!-- EN service name -->
                    <div class="form-group">
                        <label for="en_name" class="col-sm-2 control-label"><?= lang('en_service_name') ?> <span>*</span></label>
                        <div class="col-sm-6 ltr-dir">
                            <input type="text" id="en_name" autocomplete="off" class="form-control" name="en_name"
                                   value="<?php echo set_value('en_name', transText($service->name, 'en')) ?>">
                            <?php echo form_error('en_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- AR service name -->
                    <div class="form-group">
                        <label for="ar_name" class="col-sm-2 control-label"><?= lang('ar_service_name') ?> <span>*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="ar_name" autocomplete="off" class="form-control" name="ar_name"
                                   value="<?php echo set_value('ar_name', transText($service->name, 'ar')); ?>">
                            <?php echo form_error('ar_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- en description -->
                    <div class="form-group">
                        <label for="en_description" class="col-sm-2 control-label"><?= lang('en_description') ?> <span>*</span></label>
                        <div class="col-sm-9 ltr-dir">
                            <textarea class="form-control" name="en_description" id="editor1"><?php echo set_value('en_description', transText($service->description, 'en')); ?></textarea>
                            <?php echo form_error('en_description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- ar description -->
                    <div class="form-group">
                        <label for="ar_description" class="col-sm-2 control-label"><?= lang('ar_description') ?> <span>*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="ar_description" id="editor2"><?php echo set_value('ar_description', transText($service->description, 'ar')); ?></textarea>
                            <?php echo form_error('ar_description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('featured_image'); ?> <span>*</span></label>
                        <div class="col-sm-9" style="padding-top:5px">
                            <input type="file" name="image">(Only jpg, jpeg, gif and png are allowed)
                            <?php if ($service->image): ?>
                                <div> <img src="<?= site_url($service->image) ?>" class="thumb-img"></div>
                            <?php endif; ?>
                        </div>
                    </div>


<!--                    <div class="form-group">-->
<!--                        <label for="" class="col-sm-2 control-label">--><?//= lang('banner_image') ?><!-- <span>*</span></label>-->
<!--                        <div class="col-sm-9" style="padding-top:5px">-->
<!--                            <input type="file" name="banner">(Only jpg, jpeg, gif and png are allowed)-->
<!--                        </div>-->
<!--                    </div>-->
                    <h3 class="seo-info"><?= lang('seo_info'); ?></h3>

                    <!-- meta-title -->
                    <div class="form-group">
                        <label for="meta_title" class="col-sm-2 control-label"><?= lang('meta_title'); ?> </label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_title" autocomplete="off" class="form-control" name="meta_title"
                                   value="<?php echo set_value('meta_title', $service->meta_title); ?>">
                        </div>
                    </div>

                    <!-- meta-keywords -->
                    <div class="form-group">
                        <label for="meta_keyword" class="col-sm-2 control-label"><?= lang('meta_keywords') ?> </label>
                        <div class="col-sm-9">
                            <input type="text" id="meta_keyword" autocomplete="off" class="form-control" name="meta_keyword"
                                   value="<?php echo set_value('meta_keyword', $service->meta_keyword); ?>">
                        </div>
                    </div>

                    <!-- meta-description -->
                    <div class="form-group">
                        <label for="meta_description" class="col-sm-2 control-label"><?= lang('meta_description') ?> </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="meta_description" name="meta_description" style="height:140px;"><?php echo set_value('meta_description', $service->meta_description); ?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left" name="form1"><?= lang('save'); ?></button>
                            <a href="<?= site_url('services/all') ?>" class="btn btn-default m-l-10"><?= lang('cancel') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        </div>
    </div>
