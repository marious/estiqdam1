<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('localization_settings') ?></h3>
            </div>
            <?php echo form_open('settings/save_settings', $attribute= array('enctype' => "multipart/form-data")); ?>

            <div class="box-body">

                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>

             <div class="row">
                 <div class="col-md-6 col-sm-12 col-xs-12">
                     <!-- country -->
                     <div class="form-group">
                         <label for="country"><?= lang('country') ?></label>
                         <select name="settings[country]" id="country" class="form-control select2" style="width: 100%">
                             <?php foreach ($countries as $country): ?>
                                 <option value="<?= $country->country ?>" <?= setting('country') == $country->country ? 'selected' : '' ?>>
                                     <?= $country->country ?>
                                 </option>
                             <?php endforeach;?>
                         </select>
                     </div>

                     <!-- Time Zone-->
                     <div class="form-group">
                         <label for="timezone"><?= lang('time_zone') ?></label>
                         <select name="settings[time_zone]" id="timezone" class="form-control select2" style="width: 100%">
                             <?php foreach ($timezones as $timezone => $description): ?>
                                 <option value="<?= $timezone ?>" <?= setting('time_zone') == $timezone ? 'selected' : '' ?>>
                                     <?= $description ?>
                                 </option>
                             <?php endforeach; ?>
                         </select>
                     </div>


                     <!-- Currency-->
                     <div class="form-group">
                         <label><?= lang('default_currency') ?></label>
                         <select class="form-control select2" style="width: 100%;" name="settings[default_currency]">
                             <?php foreach ($countries as $item) : ?>
                                 <option value="<?php echo $item->currency_code . '-' . $item->country ?>"
                                     <?php echo setting('default_currency') == $item->currency_code . '-' . $item->country ? 'selected="selected"':'' ?>>
                                     <?php echo $item->currency_code .' - '. $item->country  ?>
                                 </option>
                             <?php endforeach; ?>
                         </select>
                     </div>


                     <?php echo $form->bs2_text('Currency Symbol', 'settings[currency_symbol]', setting('currency_symbol')); ?>

                     <!-- Currency Format-->
                     <div class="form-group">
                         <label><?= lang('currency_format') ?></label>
                         <select class="form-control select2" style="width: 100%;" name="settings[currency_format]">
                             <option value="1" <?php echo setting('currency_format') == 1 ? 'selected="selected"':'' ?>>
                                 1234.56
                             </option>
                             <option value="2" <?php echo setting('currency_format') == 2 ? 'selected="selected"':'' ?>>
                                 1,234.56
                             </option>
                             <option value="3" <?php echo setting('currency_format') == 3 ? 'selected="selected"':'' ?>>
                                 1234,56
                             </option>
                             <option value="4" <?php echo setting('currency_format') == 4 ? 'selected="selected"':'' ?>>
                                 1.234,56
                             </option>
                             <option value="5" <?php echo setting('currency_format') == 5 ? 'selected="selected"':'' ?>>
                                 1,234
                             </option>
                         </select>
                     </div>

                     <!-- Date Format-->
                     <div class="form-group">
                         <label><?= lang('date_format') ?></label>
                         <select class="form-control select2" style="width: 100%;" name="settings[date_format]">
                             <option value="d/m/Y" <?php echo setting('date_format') == 'd/m/Y' ? 'selected="selected"':'' ?> ><?= date('d/m/Y') ?></option>
                             <option value="d.m.Y" <?php echo setting('date_format') == 'd.m.Y' ? 'selected="selected"':'' ?> ><?= date('d.m.Y') ?></option>
                             <option value="d-m-Y" <?php echo setting('date_format') == 'd-m-Y' ? 'selected="selected"':'' ?> ><?= date('d-m-Y') ?></option>
                             <option value="m/d/Y" <?php echo setting('date_format') == 'm/d/Y' ? 'selected="selected"':'' ?> ><?= date('m/d/Y') ?></option>
                             <option value="Y/m/d" <?php echo setting('date_format') == 'Y/m/d' ? 'selected="selected"':'' ?> ><?= date('Y/m/d') ?></option>
                             <option value="Y-m-d" <?php echo setting('date_format') == 'Y-m-d' ? 'selected="selected"':'' ?> ><?= date('Y-m-d') ?></option>
                             <option value="M d Y" <?php echo setting('date_format') == 'M d Y' ? 'selected="selected"':'' ?> ><?= date('M d Y') ?></option>
                             <option value="d M Y" <?php echo setting('date_format') == 'd M Y' ? 'selected="selected"':'' ?> ><?= date('d M Y') ?></option>
                         </select>
                     </div>


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