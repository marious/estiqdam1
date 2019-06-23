<form class="form-horizontal" action="<?= site_url('settings/add'); ?>" method="post">
    <div class="box box-info">
        <div class="box-body">

            <!-- Company Name -->
            <div class="form-group">
                <label for="company_name" class="col-sm-2 control-label"><?= lang('company_name') ?></label>
                <div class="col-sm-6">
                    <input class="form-control" id="company_name" type="text" name="company_name" value="<?= setting('company_name') ?>">
                </div>
            </div>


            <div class="form-group">
                <label for="country" class="col-sm-2 control-label"><?= lang('country') ?></label>
                <div class="col-sm-6">
                    <select name="country" id="country" class="form-control">
                        <option value="Saudi Arabia">Saudi Arabia</option>
                    </select>
                </div>
            </div>



            <!-- Contact Phone Number -->
            <div class="form-group">
                <label for="contact_phone" class="col-sm-2 control-label"><?= lang('contact_phone'); ?> </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="<?= setting('contact_phone'); ?>">
                </div>
            </div>


            <!-- Contact Fax Number -->
            <div class="form-group">
                <label for="contact_fax" class="col-sm-2 control-label"><?= lang('contact_fax') ?></label>
                <div class="col-sm-6">
                    <input type="text" id="contact_fax" class="form-control" name="contact_fax" value="<?= setting('contact_fax'); ?>">
                </div>
            </div>


            <!--  Email Address     -->
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label"><?= lang('email') ?></label>
                <div class="col-sm-6">
                    <input type="email" id="email" class="form-control" name="email" value="<?= setting('email'); ?>" autocomplete="off">
                </div>
            </div>



            <!-- Address -->
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label"><?= lang('address') ?> </label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="address" name="address" rows="5"><?= setting('address') ?></textarea>
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success pull-left" name="form3"><?= lang('save'); ?></button>
                </div>
            </div>

        </div>
    </div>
</form>