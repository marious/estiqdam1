<br>
<div class="row">
    <div class="col-md-12">
        <form action="" class="customer-form" method="post">
            <?= csrf_field() ?>

            <div class="box box-info">
                <div class="box-body">

                    <div class="col-md-5">

                        <fieldset>
                            <legend><?= lang('new_transfer'); ?></legend>

                            <!-- From Account -->
                            <div class="form-group clearfix">
                                <label for="from" class="col-sm-4 control-label"><?= lang('from') ?> <span class="error">*</span></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <select name="from" id="from" class="form-control select2">
                                        <?php if (is_array($accounts) && count($accounts)):  ?>
                                            <option value=""><?= lang('select_account') ?></option>
                                        <?php foreach ($accounts as $account): ?>
                                                <option value="<?=$account->id?>" <?= set_select('from', $account->id) ?>><?=$account->account;?></option>
                                        <?php endforeach;  ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php echo form_error('from', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>


                            <!-- To Account -->
                            <div class="form-group clearfix">
                                <label for="to" class="col-sm-4 control-label"><?= lang('to') ?> <span class="error">*</span></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <select name="to" id="to" class="form-control select2">
                                        <option value=""><?= lang('select_account') ?></option>
                                        <?php if (is_array($accounts) && count($accounts)):  ?>
                                            <?php foreach ($accounts as $account): ?>
                                                <option value="<?=$account->id?>" <?= set_select('to', $account->id) ?>><?=$account->account;?></option>
                                            <?php endforeach;  ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php echo form_error('to', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <!-- date -->
                            <div class="form-group clearfix">
                                <label for="datepicker" class="col-sm-4 control-label"><?= lang('date') ?> <span class="error">*</span></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="text" class="form-control" id="datepicker" name="date" autocomplete="off"
                                           value="<?= set_value('date', date('d/m/Y', strtotime($transaction->date))) ?>">
                                    <?php echo form_error('date', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>

                            <!-- amount -->
                            <div class="form-group clearfix">
                                <label for="amount" class="col-sm-4 control-label"><?= lang('amount') ?> <span class="error">*</span></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <input type="number" id="amount" class="form-control" name="amount" autocomplete="off"
                                           value="<?= set_value('amount', $transaction->amount); ?>">
                                    <?php echo form_error('amount', '<div class="error">', '</div>'); ?>

                                </div>
                            </div>

                            <!-- description -->
                            <div class="form-group clearfix">
                                <label for="description" class="col-sm-4 control-label"><?= lang('description') ?> <span class="error">*</span></label>
                                <div class="col-sm-6 col-md-pull-2">
                                    <textarea  id="description" class="form-control" name="description" autocomplete="off"><?= set_value('description', $transaction->description) ?></textarea>
                                    <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>






                            <hr>
                            <div class="col-md-4 col-md-push-2">
                                <button type="submit" class="btn btn-success btn-lg"><?= lang('save'); ?></button>
                                &nbsp;
                                <a href="<?= site_url('transactions/all') ?>" class="btn btn-default btn-lg"><?= lang('cancel') ?></a>
                            </div>

                        </fieldset>



                    </div><!-- /col-md-6 -->


                    <div class="col-md-6 col-md-push-1">
                            <div class="">
                                <div class="box-title">
                                    <h5><?= lang('recent_transfers') ?></h5>

                                </div>
                                <div class="ibox-content">

                                    <table class="table table-bordered sys-table">
                                        <thead>
                                        <tr>
                                            <th><?=lang('account')?></th>
                                            <th><?=lang('description')?></th>
                                            <th><?=lang('amount');?></th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $this->load->module('transactions'); ?>
                                        <?php if (is_array($recent_transfers) && count($recent_transfers)): ?>
                                        <?php foreach ($recent_transfers as $recent_transfer): ?>
                                        <tr>
                                            <td><?= $this->transactions->get_account_name($recent_transfer) ?></td>
                                            <td><a href="">Transfer</a> </td>
                                            <td class="amount"><?=$recent_transfer->amount?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                    </div>


                    <div class="clearfix"></div>


                </div>
            </div>

        </form>
    </div>
</div>