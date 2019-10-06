<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('add_transaction') ?></h3>
            </div>

            <?= form_open('transactions/save_transaction', [
                    'id' => 'add-transaction',
                    'onSubmit' => "return get_cookie('csrf_cookie_name')"
            ]) ?>

            <div class="box-body">
                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>

                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">
                            <label for="transaction_type"><?= lang('transaction_type') ?><span class="required" aria-required="true">*</span></label>
                            <select class="form-control select2" name="transaction_type" id="transaction_type" onchange="transactionType(this)">
                                <option value=""><?= lang('please_select') ?>...</option>
                                <option value="Deposit"><?= lang('deposit') ?></option>
                                <option value="Expenses"><?= lang('expense') ?></option>
                                <option value="AP"><?= lang('accounts_payable') ?></option>
                                <option value="AR"><?= lang('accounts_receivable') ?></option>
                                <option value="TR"><?= lang('account_transfer') ?></option>
                            </select>
                        </div>


                        <div id="account" style="display: none;">
                            <div class="form-group">
                                <label for="account_select"><?= lang('account') ?> <span class="required" aria-required="true">*</span></label>
                                <select class="form-control select2" name="account" id="account_select">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php  foreach ($accounts as $account): ?>
                                        <option value="<?= $account->id ?>"><?= $account->account_title ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- account Transfer START-->
                        <div id="transfer-account" style="display: none;">
                            <div class="form-group">
                                <label for="from-account"><?= lang('from_account') ?> <span class="required" aria-required="true">*</span></label>
                                <select class="form-control select2" name="from_account" id="from-account" onchange="checkAccountCurrency()">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php  foreach ($accounts as $account): ?>
                                        <option value="<?= $account->id ?>"><?= $account->account_title ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="to-account"><?= lang('to_account') ?> <span class="required" aria-required="true">*</span></label>
                                <select class="form-control select2" name="to_account" id="to-account" onchange="checkAccountCurrency()">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php  foreach ($accounts as $account): ?>
                                        <option value="<?= $account->id ?>"><?= $account->account_title ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div><!-- /transfer-account -->

                        <!-- account Transfer END-->

                        <div class="form-group" id="trn_category">
                            <label for="category"><?= lang('category') ?> <span class="required" aria-required="true">*</span></label>
                            <select class="form-control select2" name="category_id" id="category">
                                <option value=""><?= lang('please_select') ?>...</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label id="amount"><?= lang('amount') ?> <span class="currency"></span><span class="required" aria-required="true">*</span></label>
                            <input type="text" name="amount" class="form-control numeric" id="amount" autocomplete="off">
                        </div>


                        <?php if (MULTI_CURRENCY): ?>
                        <div class="form-group" id="amount-2" style="display: none;">
                            <label for="amount_2"><?= lang('amount') ?> - <span class="currency"></span>
                                <span class="required" aria-required="true">*</span></label>
                            <input type="text" name="amount_2" class="form-control numeric" id="amount_2" autocomplete="off">
                        </div>
                        <?php endif; ?>


                        <div class="form-group" id="method" style="display: none;">
                            <label for="payment-method"><?= lang('payment_method') ?><span class="required" aria-required="true">*</span></label>
                            <select class="form-control select2" name="payment_method" id="payment-method">
                                <option value=""><?= lang('please_select') ?>...</option>
                                <option value="<?= lang('cash') ?>"><?= lang('cash') ?></option>
                                <option value="<?= lang('check') ?>"><?= lang('check') ?></option>
                                <option value="<?= lang('credit_card') ?>"><?= lang('credit_card') ?></option>
                                <option value="<?= lang('debit_card') ?>"><?= lang('debit_card') ?></option>
                                <option value="<?= lang('electronic_transfer') ?>"><?= lang('electronic_transfer') ?></option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label><?= lang('ref') ?>#</label>
                            <input type="text" name="ref" class="form-control">
                            <p class="help-block-2"><?= lang('trans_help') ?></p>
                        </div>

                        <div class="form-group">
                            <label for="description"><?= lang('description') ?><span class="required" aria-required="true">*</span></label>
                            <input type="text" name="description" class="form-control" id="description" autocomplete="off">
                        </div>

                        <p class="text-muted"><span class="required" aria-required="true">*</span> <?= lang('required_field') ?></p>


                    </div>
                </div>

                <div class="box-footer">
                    <button id="" type="submit" class="btn btn-flat btn-success"><?= lang('save_transaction') ?></button>
                </div>

            </div>


            <?= form_close() ?>

        </div><!-- ./box-primary -->
    </div>
</div>

<script>
    var select = '<?= lang('please_select') ?>';

</script>