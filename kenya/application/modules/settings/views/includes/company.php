<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('general_settings') ?></h3>
            </div>

            <?= form_open(site_url('settings/save_settings'), ['enctype' => 'multipart/form-data']) ?>

            <div class="box-body">

                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>


                <div class="row">

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <?php echo $form->bs3_text(lang('company_name'), 'settings[company_name]', setting('company_name')); ?>
                        <?php echo $form->bs3_text(lang('address'), 'settings[address]' , setting('address')); ?>
                        <?php echo $form->bs3_email(lang('email'), 'settings[email]' , setting('email')); ?>
                        <?php echo $form->bs3_text(lang('city'), 'settings[city]' , setting('city')); ?>
                        <?php echo $form->bs3_text(lang('postal_code'), 'settings[postal_code]' , setting('postal_code')); ?>
                        <?php echo $form->bs3_text(lang('phone'), 'settings[phone]' , setting('phone')); ?>
                    </div>

                </div>

            </div>

            <input type="hidden" name="tab" value="<?= $tab ?>">

            <div class="box-footer">
                <?php echo $form->bs4_submit(lang('save_settings')); ?>
            </div>

            <?= form_close() ?>

        </div>
    </div>
</div>