<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-body">

                <div class="search-box">

                    <div class="input-daterange">
                        <div class="col-md-12 m-t-10">
                            <label for="" class="col-sm-2">Date From</label>
                            <div class="col-sm-2 col-sm-pull-1">
                                <input type="text" class="form-control" id="start-date">
                            </div>
                        </div>

                        <div class="col-md-12 m-t-10">
                            <label for="" class="col-sm-2">Date To</label>
                            <div class="col-sm-2 col-sm-pull-1">
                                <input type="text" class="form-control" id="end-date">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="" class="col-sm-2">Transaction Type</label>
                        <div class="col-sm-2 col-sm-pull-1">
                            <select name="transaction_type" id="transaction-type" class="form-control">
                                <option value="">All</option>
                                <option value="Income">Income</option>
                                <option value="Expense">Expense</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-sm-2 col-sm-push-1">
                            <button class="btn btn-primary" id="search">Search</button>
                        </div>
                    </div>

                </div>


                <div class="clearfix"></div>

                <table id="transactions-table" class="table table-bordered table-striped hovered-table">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th><?=lang('date')?></th>
                        <th><?= lang('account') ?></th>
                        <th><?= lang('type') ?></th>
                        <th><?= lang('amount') ?></th>
                        <th><?= lang('description') ?></th>
                        <th>Dr.</th>
                        <th>Cr.</th>
                        <th><?= lang('balance') ?></th>
                        <th class="align-right"><?= lang('manage'); ?></th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>


    </div>
</div>



<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('delete_conf') ?></h4>
            </div>
            <div class="modal-body">
                <p><?= lang('delete_conf_msg') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
                <a class="btn btn-danger btn-ok"><?= lang('delete') ?></a>
            </div>
        </div>
    </div>
</div>