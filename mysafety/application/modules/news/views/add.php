<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="<?= site_url('news/add/'.$id); ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
                    <!-- EN service name -->
                    <div class="form-group">
                        <label for="en_name" class="col-sm-2 control-label"><?= lang('en_news_title') ?> <span class="error">*</span></label>
                        <div class="col-sm-6 ltr-dir">
                            <input type="text" id="en_name" autocomplete="off" class="form-control" name="en_name"
                                   value="<?php echo set_value('en_name', transText($news->name, 'en')) ?>">
                            <?php echo form_error('en_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- AR service name -->
                    <div class="form-group">
                        <label for="ar_name" class="col-sm-2 control-label"><?= lang('ar_news_title') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="ar_name" autocomplete="off" class="form-control" name="ar_name"
                                   value="<?php echo set_value('ar_name', transText($news->name, 'ar')); ?>">
                            <?php echo form_error('ar_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- en description -->
                    <div class="form-group">
                        <label for="en_description" class="col-sm-2 control-label"><?= lang('en_description') ?> <span class="error">*</span></label>
                        <div class="col-sm-9 ltr-dir">
                            <textarea class="form-control" name="en_description" id="editor1"><?php echo set_value('en_description', transText($news->description, 'en')); ?></textarea>
                            <?php echo form_error('en_description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- ar description -->
                    <div class="form-group">
                        <label for="ar_description" class="col-sm-2 control-label"><?= lang('ar_description') ?> <span class="error">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="ar_description" id="editor2"><?php echo set_value('ar_description', transText($news->description, 'ar')); ?></textarea>
                            <?php echo form_error('ar_description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('image'); ?> <span class="error">*</span></label>
                        <div class="col-sm-9" style="padding-top:5px">
                            <input type="file" name="image">(Only jpg, jpeg, gif and png are allowed)
                            <?php if ($news->image): ?>
                                <div> <img src="<?= site_url($news->image) ?>" class="thumb-img"></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success" name="form1"><?= lang('save'); ?></button>
                            <a href="<?= site_url('news/all') ?>" class="btn btn-default m-l-10"><?= lang('cancel') ?></a>

                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
