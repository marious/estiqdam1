<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="<?= site_url('offers/add/'.$id); ?>" method="post" enctype="multipart/form-data">



            <div class="box box-info">
                <div class="box-body">

                    <div class="form-group">
                        <label for="en_offer_heading" class="col-sm-2 control-label"><?= lang('en_offer_title') ?> <span class="error">*</span></label>
                        <div class="col-sm-6 ltr-dir">
                            <input type="text" id="en_offer_heading" autocomplete="off" class="form-control" name="en_offer_heading"
                                   value="<?php echo set_value('en_offer_heading', transText($offer->offer_heading, 'en')) ?>">
                            <?php echo form_error('en_offer_heading', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ar_offer_heading" class="col-sm-2 control-label"><?= lang('ar_offer_title') ?> <span class="error">*</span></label>
                        <div class="col-sm-6 ltr-dir">
                            <input type="text" id="ar_offer_heading" autocomplete="off" class="form-control" name="ar_offer_heading"
                                   value="<?php echo set_value('ar_offer_heading', transText($offer->offer_heading, 'ar')) ?>">
                            <?php echo form_error('ar_offer_heading', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="en_offer_content" class="col-sm-2 control-label"><?= lang('en_offer_content') ?> <span class="error">*</span></label>
                        <div class="col-sm-9 ltr-dir">
                            <textarea class="form-control" name="en_offer_content" id="editor2"><?php echo set_value('en_offer_content', transText($offer->offer_content, 'en')); ?></textarea>
                            <?php echo form_error('en_offer_content', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="ar_offer_content" class="col-sm-2 control-label"><?= lang('ar_offer_content') ?> <span class="error">*</span></label>
                        <div class="col-sm-9 ltr-dir">
                            <textarea class="form-control" name="ar_offer_content" id="editor1"><?php echo set_value('ar_offer_content', transText($offer->offer_content, 'ar')); ?></textarea>
                            <?php echo form_error('ar_offer_content', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('image'); ?> <span class="error">*</span></label>
                        <div class="col-sm-9" style="padding-top:5px">
                            <input type="file" name="image">(Only jpg, jpeg, gif and png are allowed)
                            <?php if ($offer->image): ?>
                                <div> <img src="<?= site_url($offer->image) ?>" class="thumb-img"></div>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="start_at" class="col-sm-2 control-label"><?= lang('start_at') ?> <span class="error">*</span></label>
                        <div class="col-sm-2">
                            <input type="text" id="start_at" autocomplete="off" class="form-control datepicker" name="start_at"
                                   value="<?php echo set_value('start_at', dateFormat($offer->start_at, 'd-m-Y')) ?>">
                            <?php echo form_error('start_at', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="end_at" class="col-sm-2 control-label"><?= lang('end_at') ?> <span class="error">*</span></label>
                        <div class="col-sm-2">
                            <input type="text" id="end_at" autocomplete="off" class="form-control datepicker" name="end_at"
                                   value="<?php echo set_value('end_at', dateFormat($offer->end_at, 'd-m-Y')) ?>">
                            <?php echo form_error('end_at', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success" name="form1"><?= lang('save'); ?></button>
                            <a href="<?= site_url('offers/all') ?>" class="btn btn-default m-l-10"><?= lang('cancel') ?></a>

                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>
</div>