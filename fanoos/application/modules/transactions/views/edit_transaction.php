<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('edit_transaction') ?></h3>
            </div>

            <div class="box-body">

                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <?= form_open('transactions/update_transaction', ['class' => 'form-horizontal']) ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="val-username"><?= lang('transaction_id') ?></label>
                            <div class="col-md-7">
                                <input class="form-control" value="<?php echo $transaction->transaction_id ?>" disabled type="text">
                            </div>
                        </div>


                        <?php if (empty($transaction_from)): ?>
                            <?php if ($transaction->account_id != 2 && $transaction->account_id != 4): ?>
                                <!-- deposit, expense-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="val-email"><?= lang('account') ?></label>
                                    <div class="col-md-7">
                                        <input class="form-control" value="<?php echo $transaction->account_title ?>" disabled type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="val-password"><?= lang('transaction_type') ?></label>
                                    <div class="col-md-7">
                                        <input class="form-control" value="<?php echo $transaction->transaction_type ?>" disabled  type="text">
                                    </div>
                                </div>

                            <?php else: ?>
                                <!-- A/P, A/R -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="val-email"><?= lang('transaction_type') ?></label>
                                    <div class="col-md-7">
                                        <input class="form-control" value="<?php echo $transaction->account_title ?>" disabled type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="val-email"><?= lang('change_account') ?></label>
                                    <div class="col-md-7">
                                        <select class="form-control select2" name="account" >
                                            <option value=""><?= lang('please_select') ?>...</option>
                                            <?php foreach($accounts as $item){ ?>
                                                <option value="<?php echo $item->id ?>"><?php echo $item->account_title ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="val-email"><?= lang('payment_method') ?></label>
                                    <div class="col-md-7">
                                        <select class="form-control select2" name="payment_method">
                                            <option value=""><?= lang('please_select') ?>...</option>
                                            <option value="<?= lang('cash') ?>"><?= lang('cash') ?></option>
                                            <option value="<?= lang('check') ?>"><?= lang('check') ?></option>
                                            <option value="<?= lang('credit_card') ?>"><?= lang('credit_card') ?></option>
                                            <option value="<?= lang('debit_card') ?>"><?= lang('debit_card') ?></option>
                                            <option value="<?= lang('electronic_transfer') ?>"><?= lang('electronic_transfer') ?></option>
                                            <option value="<?= lang('online_payment') ?>"><?= lang('online_payment') ?></option>
                                        </select>
                                    </div>
                                </div>

                            <?php endif; ?>

                        <?php else: ?>
                            <!--  transaction between two account-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="val-email"><?= lang('from_account') ?></label>
                                <div class="col-md-7">
                                    <input class="form-control" value="<?php echo $transaction_from->account_title ?>" disabled type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" ><?= lang('to_account') ?></label>
                                <div class="col-md-7">
                                    <input class="form-control" value="<?php echo $transaction->account_title ?>" disabled  type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?= lang('transaction_type') ?></label>
                                <div class="col-md-7">
                                    <input class="form-control" value="<?php echo $transaction->transaction_type ?>" disabled  type="text">
                                </div>
                            </div>

                        <?php endif; ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?= lang('category') ?></label>
                            <div class="col-md-7">
                                <input class="form-control" value="<?php echo $transaction->category_name ?>" disabled  type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?= lang('amount') ?></label>
                            <div class="col-md-7">
                                <input class="form-control" value="<?php echo $transaction->amount ?>" disabled  type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?= lang('balance') ?></label>
                            <div class="col-md-7">
                                <input class="form-control" value="<?php echo $transaction->balance ?>" disabled  type="text">
                            </div>
                        </div>

                        <?php if($transaction->account_id != 2 && $transaction->account_id != 4 ){ ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?= lang('payment_method') ?></label>
                                <div class="col-md-7">
                                    <input class="form-control" value="<?php echo $transaction->payment_method ?>" disabled  type="text">
                                </div>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?= lang('description') ?></label>
                            <div class="col-md-7">
                                <input class="form-control" value="<?php echo $transaction->description ?>" name="description"  type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?= lang('ref') ?>#</label>
                            <div class="col-md-7">
                                <input class="form-control" value="<?php echo $transaction->ref ?>"  name="ref" type="text">
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $this->encryption->encrypt($transaction->id); ?>">

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn bg-navy btn-flat" type="submit"><?= lang('update_transaction') ?></button>
                            </div>
                        </div>

                        <?= form_close() ?>
                    </div>
                </div>

            </div>
        </div><!-- ./box -->
    </div>
</div>