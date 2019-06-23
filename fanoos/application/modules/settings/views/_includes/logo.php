<form class="form-horizontal" action="<?= site_url('settings/add'); ?>" method="post" enctype="multipart/form-data">
    <div class="box box-info">
        <div class="box-body">
            <?php //if (setting('logo')): ?>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><?= lang('existing_logo'); ?></label>
                <div class="col-sm-6" style="padding-top:6px;">
                    <img src="<?= site_url(setting('')); ?>" class="existing-photo" style="height:80px;">
                </div>
            </div>
            <?php //endif; ?>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><?= lang('new_logo'); ?></label>
                <div class="col-sm-6" style="padding-top:6px;">
                    <input type="file" name="logo">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success pull-left" name="form1"><?= lang('update_logo'); ?></button>
                </div>
            </div>
        </div>
    </div>
</form>