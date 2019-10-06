<div class="row">
    <div class="col-md-12">

        <div class="wrap-fpanel">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title"><?= lang('transaction') ?> <?= lang('report') ?></h3>
                </div>

                <div class="panel-body">
                    <?= form_open('reports/transaction', ['class' => 'form-horizontal']) ?>

                    <div class="panel_controls">

                        <div class="form-group margin">
                            <label class="col-sm-3 control-label" for="start-date"><?= lang('from') ?> <span class="required">*</span></label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="start-date" name="start_date" data-date-format="yyyy/mm/dd"
                                           value="<?php if(!empty($search['start_date'])) echo $search['start_date'] ?>" autocomplete="off">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="end_date"><?= lang('to') ?> <span class="required">*</span></label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="end_date" name="end_date" data-date-format="yyyy/mm/dd"
                                            value="<?php if(!empty($search['end_date'])) echo $search['end_date'] ?>" autocomplete="off">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="account_title"><?= lang('account') ?></label>
                            <div class="col-sm-5">
                                <select class="form-control select2" name="account" id="account_title">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php foreach($accounts as $item){ ?>
                                        <option value="<?php echo $item->id ?>" <?php if(!empty($search['account_id'])) echo $search['account_id'] == $item->id ? 'selected':'' ?>>
                                            <?php echo $item->account_title ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="transaction_type"><?= lang('transaction_type') ?></label>
                            <div class="col-sm-5">
                                <select class="form-control select2" name="transaction_type" id="transaction_type">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <option value="1" <?php if(!empty($search['transaction_type'])) echo $search['transaction_type'] == 1 ? 'selected':'' ?>><?= lang('deposit') ?></option>
                                    <option value="2" <?php if(!empty($search['transaction_type'])) echo $search['transaction_type'] == 2 ? 'selected':'' ?>><?= lang('expense') ?></option>
                                    <option value="5" <?php if(!empty($search['transaction_type'])) echo $search['transaction_type'] == 5 ? 'selected':'' ?>><?= lang('transfer') ?></option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('submit') ?></button>
                            </div>
                        </div>


                    </div>

                    <input type="hidden" name="flag" value="1">
                    <?= form_close() ?>

                    <?php
                    $total_dr = 0;
                    $total_cr = 0;
                    $total_balance = 0;
                    ?>
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
                        <?php if (is_array($transactions) && count($transactions)): ?>
                        <?php
                        $currency = '';
                        if (MULTI_CURRENCY) {
                            $currency = $transactions[0]->account_currency ? explode('-', $transactions[0]->account_currency)[0] :
                                    setting('currency_symbol');
                        }
                            ?>
                        <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?= $transaction->transaction_id ?></td>
                            <td><?= $transaction->account_title ?></td>
                            <td><?= $transaction->transaction_type ?></td>
                            <td><?= $transaction->name ?></td>
                            <td>
                                <?php
                                if ($transaction->transaction_type_id == 1 || $transaction->transaction_type_id == 4)
                                {
                                    echo '<span class="dr">'.$this->localization->currencyFormat($transaction->amount).'</span>';
                                    $dr_amount = $transaction->amount;
                                }
                                else
                                {
                                    echo '<span class="dr">'.$this->localization->currencyFormat(0).'</span>';
                                    $dr_amount = 0;
                                }
                                $total_dr += $dr_amount;
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($transaction->transaction_type_id == 2 || $transaction->transaction_type_id == 3 || $transaction->transaction_type_id == 5)
                                {
                                    echo '<span class="cr">'.$this->localization->currencyFormat($transaction->amount).'</span>';
                                    $cr_amount = $transaction->amount;
                                }
                                else
                                {
                                    echo '<span class="cr">'.$this->localization->currencyFormat(0).'</span>';
                                    $cr_amount = 0;
                                }
                                $total_cr += $cr_amount;
                                ?>
                            </td>
                            <td>
                                <?php echo '<span class="balance">'.$this->localization->currencyFormat($transaction->balance).'</span>'; ?>
                                <?php $total_balance += $transaction->balance; ?>
                            </td>
                            <td><?php echo $this->localization->dateFormat($transaction->date_time); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <?php endif; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>= <?= $total_dr . ' ' . $currency ?></strong></td>
                            <td><strong>= <?= $total_cr . ' ' . $currency?></strong></td>
                            <td><strong>= <?= $total_balance . ' ' . $currency?></strong></td>
                            <td></td>
                        </tr>
                    </table>

                </div>

            </div>
        </div>

    </div>
</div>