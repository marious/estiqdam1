<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Operations</div>
            <div class="panel-body" id="operations">
                <form>
                <div class="col-md-6">

                    <div class="form-group clearfix">
                        <label for="from" class="col-sm-3 control-label"><?= lang('account') ?> <span class="error">*</span></label>
                        <div class="col-sm-5 col-md-pull-1">
                            <select name="account" id="from" class="form-control select2">
                                <?php if (is_array($accounts) && count($accounts)):  ?>
                                    <option value="0"><?= lang('select_account') ?></option>
                                    <?php foreach ($accounts as $account): ?>
                                        <option value="<?=$account->id?>" <?= set_select('from', $account->id) ?>><?=$account->account;?></option>
                                    <?php endforeach;  ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label for="branch" class="col-sm-3 control-label"><?= lang('branch') ?> </label>
                        <div class="col-sm-5 col-md-pull-1">
                            <select name="" id="from" class="form-control select2">
                                <option value=""><?= lang('unspecified') ?></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group clearfix">
                        <label for="receipt_number" class="col-sm-3 control-label"><?= lang('receipt_number') ?> </label>
                        <div class="col-sm-5 col-md-pull-1">
                            <input type="text" class="form-control" name="receipt_number" id="receipt_number">
                        </div>
                    </div>

                    <!-- description -->
                    <div class="form-group clearfix">
                        <label for="description" class="col-sm-3 control-label"><?= lang('description') ?> <span class="error">*</span></label>
                        <div class="col-sm-5 col-md-pull-1">
                            <textarea  id="description" class="form-control" name="description" autocomplete="off"><?= set_value('description') ?></textarea>
                            <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>




                </div><!-- col-md-6 -->


                <div class="col-md-6">

                    <div class="form-group clearfix" v-if="showToAccount">
                        <label for="customer_name" class="col-sm-3 control-label"><?= lang('to') ?> <span class="error">*</span></label>
                        <div class="col-sm-5 col-md-pull-1">
                            <select name="" id="from" class="form-control select2">
                                <?php if (is_array($accounts) && count($accounts)):  ?>
                                    <option value=""><?= lang('select_account') ?></option>
                                    <?php foreach ($accounts as $account): ?>
                                        <option value="<?=$account->id?>" <?= set_select('from', $account->id) ?>><?=$account->account;?></option>
                                    <?php endforeach;  ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label for="datepicker" class="col-sm-3 control-label"><?= lang('date') ?> <span class="error">*</span></label>
                        <div class="col-sm-5 col-md-pull-1">
                            <input type="text" name="date" id="datepicker" class="form-control" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label for="type" class="col-sm-3 control-label"><?= lang('operation') ?> <span class="error">*</span></label>
                        <div class="col-sm-5 col-md-pull-1">
                            <select name="type" id="type" class="form-control" @change="changeType">
                                <option value="">-- <?= lang('select_operation') ?> --</option>
                                <option value="Transfer"><?= lang('transfer'); ?></option>
                                <option value="Income"><?= lang('income'); ?></option>
                                <option value="Expense"><?= lang('expense') ?></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group clearfix">
                        <label for="customer" class="col-sm-3 control-label"><?= lang('customers') ?></label>
                        <div class="col-sm-5 col-md-pull-1">
                            <select class="form-control" id="customers">
                                <option value="0">-- select --</option>
                            </select>
                        </div>
                    </div>


                    <!-- amount -->
                    <div class="form-group clearfix">
                        <label for="amount" class="col-sm-3 control-label"><?= lang('amount') ?> <span class="error">*</span></label>
                        <div class="col-sm-5 col-md-pull-1">
                            <input type="number" id="amount" class="form-control" name="amount" autocomplete="off"
                                   value="<?= set_value('amount'); ?>">
                            <?php echo form_error('amount', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>





                </div><!-- ./col-md-6 -->

                </form>


            </div>
        </div>
    </div>
</div>