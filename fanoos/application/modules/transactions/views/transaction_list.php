<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('transactions_list') ?></h3>
                <div class="box-tools" style="padding-top: 5px">
                    <div class="input-group input-group-sm" >

                    </div>
                </div>
            </div>

            <div class="box-body">

                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>

                <div class="row">
                    <div class="col-md-12">

                        <div class="well well-sm">
                            <div class="row">
                                <?= form_open('transactions/search_transactions', ['id' => 'add-transaction']) ?>

                                <div class="col-md-11">

                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group form-group-bottom">
                                            <label for="start-date"><?= lang('start_date') ?></label>

                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" id="start-date" name="start_date" data-date-format="dd/mm/yyyy" autocomplete="off">
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
                                                <input type="text" class="form-control datepicker" id="end-date" name="end_date" data-date-format="dd/mm/yyyy" autocomplete="off">
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
                                                    <option value="<?php echo $account->id ?>"><?php echo $account->account_title ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label><?= lang('transaction_type') ?></label>
                                            <select class="form-control select2" name="transaction_type" id="transaction_type" onchange="transactionType(this)">
                                                <option value=""><?= lang('please_select') ?>...</option>
                                                <option value="1"><?= lang('deposit') ?></option>
                                                <option value="2"><?= lang('expense') ?></option>
                                                <option value="5"><?= lang('transfer') ?></option>
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


                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                <th style="width:80px;"><?= lang('actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div><!-- ./box-body -->

        </div><!-- ./box-primary -->
    </div>
</div>

<script>
    let list = 'transactions/transaction_list';
</script>