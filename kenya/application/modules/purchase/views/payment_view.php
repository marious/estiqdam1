<div class="table">
    <div class="table-responsive">
        <h2><?= lang('payment_info') ?></h2>
        <table class="table table-bordered table-hover" id="tireFields">
            <thead>
            <tr style="background-color: #00a65a; color: #f5f5f5; font-weight: bold;">
                <th width="15%"><?= lang('payment_date') ?></th>
                <th width="15%"><?= lang('reference_no') ?></th>
                <th width="15%"><?= lang('amount') ?></th>
                <th width="15%"><?= lang('from_account') ?></th>
                <th width="15%"><?= lang('payment_method') ?></th>
                <th width="15%"><?= lang('category') ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input name="payment_date" value="<?php if(isset($payment) && !empty($payment)) echo $payment->payment_date ?>" class="form-control datepicker"
                           data-date-format="dd/mm/yyyy" type="text" autocomplete="off">
                </td>
                <td>
                    <input name="order_ref" class="form-control" value="<?php if(isset($payment) && !empty($payment)) echo $payment->order_ref ?>"
                           type="text" autocomplete="off">
                </td>
                <td>
                    <input id="amount" name="amount" class="form-control" value=""
                           type="text" onkeyup="receivedAmount(this);" autocomplete="off">
                    <span style=" color: #E13300" id="msg"></span>
                    <input type="hidden" value="" id="due" >
                </td>
                <td>
                    <select  id="from_account" name="from_account" class="form-control">
                        <option value="">-- <?= lang('select_account') ?> --</option>
                        <?php if (is_array($accounts) && count($accounts)): ?>
                            <?php foreach ($accounts as $account): ?>
                                <option value="<?= $account->id ?>"><?= $account->account_title ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td>
                    <select id="method" class="form-control" name="payment_method">
                        <option value=""><?= lang('please_select') ?>...</option>
                        <option value="<?= lang('cash') ?>"><?= lang('cash') ?></option>
                        <option value="<?= lang('check') ?>"><?= lang('check') ?></option>
                        <option value="<?= lang('credit_card') ?>"><?= lang('credit_card') ?></option>
                        <option value="<?= lang('debit_card') ?>"><?= lang('debit_card') ?></option>
                        <option value="<?= lang('electronic_transfer') ?>"><?= lang('electronic_transfer') ?></option>
                    </select>
                </td>
                <td>
                    <?php if (is_array($categories) && count($categories)): ?>
                    <select name="category" id="category" class="form-control">
                        <option value=""><?= lang('please_select') ?></option>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php endif; ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<table class="table table-hover">
    <thead>
    <tr style="border-bottom: 1px solid #ccc;">
        <th style="width: 15px"></th>
        <th class="col-sm-2"></th>
        <th class="col-sm-5"></th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td colspan="5" style="text-align: right; font-weight: bold;"><?= lang('description') ?></td>
        <td style="text-align: right; padding-right: 30px">
            <input type="text" class="form-control" name="description">
        </td>
    </tr>





    </tbody>
</table>