<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="<?= site_url('slider/add/'.$id) ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Photo <span class="error">*</span></label>
                        <div class="col-sm-9" style="padding-top:5px">
                            <input type="file" name="image">(Only jpg, jpeg, gif and png are allowed)
                            <?php if ($slider->image): ?>
                                <div> <img src="<?= site_url($slider->image) ?>" class="thumb-img"></div>
                            <?php endif; ?>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('en_heading'); ?> </label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" class="form-control" name="en_heading"
                                   value="<?= set_value('en_heading', transText($slider->heading, 'en')); ?>">

                            <?php echo form_error('en_heading', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('ar_heading'); ?> </label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" class="form-control" name="ar_heading"
                                   value="<?= set_value('ar_heading', transText($slider->heading, 'ar')); ?>">
                            <?php echo form_error('ar_heading', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('en_content'); ?> </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="en_content" style="height:140px;"><?=set_value('en_content', transText($slider->content, 'en'));?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('ar_content'); ?> </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="ar_content" style="height:140px;"><?=set_value('en_content', transText($slider->content, 'ar'));?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('en_button_text'); ?> </label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" class="form-control" name="en_button_text" value="<?=set_value('button_text', transText($slider->button_text, 'en'));?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('ar_button_text'); ?> </label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" class="form-control" name="ar_button_text" value="<?=set_value('button_text', transText($slider->button_text, 'ar'));?>">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('button_url'); ?></label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" class="form-control" name="button_url" value="<?= set_value('button_url', $slider->button_url);?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('position') ?> </label>
                        <div class="col-sm-6">
                            <select name="position" class="form-control">
                                <option value="Left" <?php echo $slider->position == 'Left' ? 'selected' : ''; ?>>Left</option>
                                <option value="Center" <?php echo $slider->position == 'Center' ? 'selected' : ''; ?>>Center</option>
                                <option value="Right" <?php echo $slider->position == 'Right' ? 'selected' : ''; ?>>Right</option>
                            </select>
                            <?= form_error('position', '<div class="error">', '</div>') ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('active'); ?> </label>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" <?= set_radio('status', '1', true) ?> <?php if ($slider->status == '1') echo 'checked'; ?>><?= lang('yes') ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0" <?= set_radio('status', '0') ?> <?php if ($slider->status == '0') echo 'checked'; ?>><?= lang('no') ?>
                            </label>
                            <?= form_error('status', '<div class="error">', '</div>') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left" name="form1"><?=lang('save');?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>