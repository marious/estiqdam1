<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('search_transaction') ?></h3>
            </div>

            <div class="box-body">

                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm">
                            <div class="row">

                                <?= form_open('transactions/search_transactions') ?>

                                <div class="col-md-11">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group form-group-bottom">
                                            <label for="start-date"><?= lang('start_date') ?></label>

                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" id="start-date" name="start_date" data-date-format="dd/mm/yyyy"
                                                       autocomplete="off" value="<?= !empty($search['start_date']) ? $search['start_date'] : '' ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group form-group-bottom">
                                            <label for="end-date"><?= lang('end_date') ?></label>

                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" id="end-date" name="end_date" data-date-format="dd/mm/yyyy"
                                                       autocomplete="off" value="<?= !empty($search['end_date']) ? $search['end_date'] : '' ?>">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group form-group-bottom">
                                            <label for="account"><?= lang('account') ?></label>

                                            <select class="form-control select2" name="account" id="account">
                                                <option value=""><?= lang('please_select') ?>...</option>
                                                <?php foreach($accounts as $account){ ?>
                                                    <option value="<?php echo $account->id ?>" <?= !empty($search['account_id']) && $search['account_id'] == $account->id ? 'selected' : '' ?>>
                                                        <?php echo $account->account_title ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label><?= lang('transaction_type') ?></label>
                                            <select class="form-control select2" name="transaction_type" id="transaction_type" onchange="transactionType(this)">
                                                <option value=""><?= lang('please_select') ?>...</option>
                                                <option value="1" <?= !empty($search['transaction_type']) && $search['transaction_type'] == 1 ? 'selected' : '' ?>><?= lang('deposit') ?></option>
                                                <option value="2" <?= !empty($search['transaction_type']) && $search['transaction_type'] == 2 ? 'selected' : '' ?>><?= lang('expense') ?></option>
                                                <option value="5" <?= !empty($search['transaction_type']) && $search['transaction_type'] == 5 ? 'selected' : '' ?>><?= lang('transfer') ?></option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-1 col-sm-6 col-xs-12">
                                        <div class="form-group form-group-bottom" style="padding-top: 25px;">
                                            <button type="submit" class="btn bg-blue btn-flat btn-sm"><i class="fa fa-search" aria-hidden="true"></i>
                                                <?= lang('search') ?></button>
                                        </div>
                                    </div>

                                </div>

                                <?= form_close() ?>

                            </div>
                        </div>

                        <table class="table table-striped table-bordered display-all" cellspacing="0" width="100%">
                           <thead>
                               <tr>
                                   <th><?= lang('trns_id') ?></th>
                                   <th><?= lang('account') ?></th>
                                   <th><?= lang('type') ?></th>
                                   <th><?= lang('category') ?></th>
                                   <th><?= lang('dr') ?>.</th>
                                   <th><?= lang('cr') ?>.</th>
                                   <th><?= lang('balance') ?></th>
                                   <th><?= lang('date') ?></th>
                               </tr>
                           </thead>
                            <tbody>
                                <?php if(is_array($transactions) && count($transactions)): ?>
                                <?php foreach ($transactions as $transaction): ?>
                                    <tr>
                                        <td><?= $transaction->transaction_id ?></td>
                                        <td><?= $transaction->account_title ?></td>
                                        <td><?= $transaction->transaction_type ?></td>
                                        <td><?= $transaction->name ?></td>
                                        <td>
                                            <?php if ($transaction->transaction_type_id == 1 || $transaction->transaction_type_id == 4): ?>
                                            <span class="dr"><?= $this->localization->currencyFormat($transaction->amount) ?></span>
                                            <?php else: ?>
                                                <span class="dr"><?= $this->localization->currencyFormat(0) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($transaction->transaction_type_id == 2 || $transaction->transaction_type_id == 3 || $transaction->transaction_type_id == 5): ?>
                                                <span class="cr"><?= $this->localization->currencyFormat($transaction->amount) ?></span>
                                            <?php else: ?>
                                                <span class="cr"><?= $this->localization->currencyFormat(0) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="balance"><?= $this->localization->currencyFormat($transaction->balance) ?></span>
                                        </td>
                                        <td>
                                            <?= $this->localization->dateFormat($transaction->date_time) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div><!-- ./box-primary -->
    </div>
</div>