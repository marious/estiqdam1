<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="<?= site_url('permissions/add'); ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">

                    <!-- username -->
                    <div class="form-group">
                        <label for="permission" class="col-sm-2 control-label"><?= lang('permission_name') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="permission" autocomplete="off" class="form-control" name="display_name"
                                   value="<?php echo set_value('permission') ?>">
                            <?php echo form_error('display_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <br>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left" name="form1"><?= lang('save'); ?></button>
                            <a href="<?= site_url('news/all') ?>" class="btn btn-default m-l-10"><?= lang('cancel') ?></a>
                            <a href="<?= site_url('news/all') ?>" class="btn btn-default m-l-10"><?= lang('cancel') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

