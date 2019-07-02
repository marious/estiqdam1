<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="<?= site_url('clients/add/'.$id); ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
                    <!-- EN category name -->
                    <div class="form-group">
                        <label for="en_name" class="col-sm-2 control-label"><?= lang('en_name') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="en_name" autocomplete="off" class="form-control" name="en_name"
                                   value="<?php echo set_value('en_name', transText($client->name, 'en')) ?>">
                            <?php echo form_error('en_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- AR category name -->
                    <div class="form-group">
                        <label for="ar_name" class="col-sm-2 control-label"><?= lang('ar_name') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="ar_name" autocomplete="off" class="form-control" name="ar_name"
                                   value="<?php echo set_value('ar_name', transText($client->name, 'ar')); ?>">
                            <?php echo form_error('ar_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('image'); ?> <span>*</span></label>
                        <div class="col-sm-9" style="padding-top:5px">
                            <input type="file" name="image">(Only jpg, jpeg, gif and png are allowed)
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left" name="form1"><?= lang('save'); ?></button>
                            <a href="<?= site_url('clients/all') ?>" class="btn btn-default m-l-10"><?= lang('cancel') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
