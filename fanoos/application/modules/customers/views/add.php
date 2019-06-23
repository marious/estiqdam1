<div class="row">
    <div class="col-md-12">
        <form action="" class="customer-form" method="post">

            <div class="box box-info">
                <div class="box-body">

                    <div class="col-md-6">

                        <fieldset>
                            <legend><?= lang('customer_info'); ?></legend>

                            <!-- customer Name -->
                            <div class="form-group clearfix">
                                <label for="customer_name" class="col-sm-4 control-label"><?= lang('customer_name') ?> <span class="error">*</span></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" id="customer_name" autocomplete="off" class="form-control"
                                           name="customer_name" value="<?= set_value('customer_name', $customer->title) ?>">
                                    <?php echo form_error('customer_name', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <!-- branch -->
                            <div class="form-group clearfix">
                                <label for="branch" class="col-sm-4 control-label"><?= lang('branch') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <select name="branch_id" id="branch" class="form-control">
                                        <?php foreach ($branches as $branch): ?>
                                        <option value="<?= $branch->id ?>"><?= $branch->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- status -->
                            <div class="form-group clearfix">
                                <label for="" class="col-sm-2 control-label"><?= lang('status'); ?> </label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" class="minimal"
                                                <?php if ($customer->status == 1) echo 'checked'; ?>> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" class="minimal"
                                            <?php if ($customer->status == 0) echo 'checked'; ?>> Not Active
                                    </label>
                                </div>
                            </div>

                            <!-- telephone -->
                            <div class="form-group clearfix">
                                <label for="telephone" class="col-sm-4 control-label"><?= lang('telephone') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" id="telephone" autocomplete="off"
                                           class="form-control" name="telephone" value="<?= set_value('telephone', $customer->tel) ?>">
                                </div>
                            </div>

                            <!-- Mobile -->
                            <div class="form-group clearfix">
                                <label for="mobile" class="col-sm-4 control-label"><?= lang('mobile') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" id="mobile" autocomplete="off"
                                           class="form-control" name="mobile" value="<?= set_value('mobile', $customer->mobile) ?>">
                                </div>
                            </div>

                            <!-- Fax -->
                            <div class="form-group clearfix">
                                <label for="fax" class="col-sm-4 control-label"><?= lang('fax') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" id="fax" autocomplete="off"
                                           class="form-control" name="fax" value="<?= set_value('fax', $customer->fax) ?>">
                                </div>
                            </div>

                            <!-- E-mail -->
                            <div class="form-group clearfix">
                                <label for="email" class="col-sm-4 control-label"><?= lang('email') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="email" id="email" autocomplete="off"
                                           class="form-control" name="email" value="<?= set_value('email', $customer->email) ?>">
                                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <!-- work address -->
                            <div class="form-group clearfix">
                                <label for="work_address" class="col-sm-4 control-label"><?= lang('work_address') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" id="work_address" autocomplete="off" class="form-control"
                                           name="work_address" value="<?= set_value('work_address', $customer->work_address) ?>">
                                </div>
                            </div>

                            <!-- home address -->
                            <div class="form-group clearfix">
                                <label for="home_address" class="col-sm-4 control-label"><?= lang('home_address') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" id="home_address" autocomplete="off" class="form-control"
                                           name="home_address" value="<?= set_value('home_address', $customer->home_address) ?>">
                                </div>
                            </div>

                            <!-- tax_record_no -->
                            <div class="form-group clearfix">
                                <label for="tax_record_no" class="col-sm-4 control-label"><?= lang('tax_record_no') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" id="tax_record_no" autocomplete="off" class="form-control"
                                           name="tax_record_no" value="<?= set_value('tax_record_no', $customer->tax_record_no) ?>">
                                </div>
                            </div>


                            <!-- customer level -->
                            <div class="form-group clearfix">
                                <label for="customer_level" class="col-sm-4 control-label"><?= lang('customer_level') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <select name="customer_level" class="form-control" id="customer_level">
                                        <?php foreach ($customer_levels as $customer_level): ?>
                                            <?php
                                        $selected = '';
                                        if ($customer_level->id == $customer->customer_level) {
                                            $selected = 'selected';
                                        }
                                            ?>
                                            <option value="<?= $customer_level->id ?>" <?= $selected ?>><?= $customer_level->level ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Price Types  -->
                            <div class="form-group clearfix">
                                <label for="price_types" class="col-sm-4 control-label"><?= lang('price_type') ?></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <select name="price_types" class="form-control" id="price_types">
                                        <?php foreach ($price_types as $price_type): ?>
                                            <?php

                                            ?>
                                            <option value="<?= $price_type->id ?>"><?= transText($price_type->type, $lang) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <!-- Customer Type -->
                            <div class="form-group clearfix">
                                <label for="" class="col-sm-2 control-label"><?= lang('customer_type'); ?> </label>
                                <div class="col-sm-6">
                                    <?php foreach ($customer_types as $customer_type): ?>
                                    <?php
                                    $checked = '';
                                        if ($customer_type->id == $customer->customer_type) {
                                            $checked = 'checked';
                                        }
                                        ?>
                                    <label class="radio-inline">
                                        <input type="radio" name="customer_type" value="<?= $customer_type->id ?>" class="minimal" <?= $checked ?>>
                                        <?= transText($customer_type->type, $lang) ?>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- notes -->
                            <div class="form-group clearfix">
                                <label for="notes" class="col-sm-2 control-label"><?= lang('notes'); ?> </label>
                                <div class="col-sm-6">
                                    <textarea name="notes" id="notes"  rows="4" class="form-control"><?= set_value('notes', $customer->notes) ?></textarea>
                                </div>
                            </div>


                        </fieldset>



                    </div><!-- /col-md-6 -->


                    <div class="col-md-6">
                        <fieldset>
                            <legend><?=lang('opening_balance')?></legend>

                            <!-- opening balance -->
                            <div class="form-group clearfix">
                                <label for="start_balance" class="col-sm-3 control-label"><?= lang('start_balance'); ?> </label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="start_balance" name="start_balance"
                                           autocomplete="off" value="<?= set_value('start_balance', $customer->start_balance); ?>">
                                    <?php echo form_error('start_balance', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label for="balance_type" class="col-sm-3 control-label"><?= lang('balance_type'); ?> </label>
                                <div class="col-sm-6">

                                    <?php foreach ($balance_types as $balance_type): ?>
                                    <label class="radio-inline">
                                        <input type="radio" name="balance_type" value="<?= $balance_type->id ?>" class="minimal">
                                            <?= transText($balance_type->type, $lang) ?>
                                    </label>
                                    <?php endforeach; ?>

                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label for="datepicker" class="col-sm-3 control-label"><?= lang('balance_date'); ?> </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="datepicker" name="balance_date" autocomplete="off"
                                             value="<?= set_value('balance_date', date('d/m/Y', strtotime($customer->balance_date))) ?>">
                                </div>
                            </div>


                        </fieldset>

                    </div>


                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-md-4 col-md-push-4">
                        <button type="submit" class="btn btn-success btn-lg"><?= lang('save'); ?></button>
                        &nbsp;
                        <a href="<?= site_url('customers/all') ?>" class="btn btn-default btn-lg"><?= lang('cancel') ?></a>
                    </div>

                </div>
            </div>

        </form>
    </div>
</div>