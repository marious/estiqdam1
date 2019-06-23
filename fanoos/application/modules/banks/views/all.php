<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-body">


                <table id="accounts-table" class="table table-bordered table-striped hovered-table">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th><?=lang('name')?></th>
                        <th><?= lang('balance') ?></th>
                        <th><?= lang('account_number') ?></th>
                        <th><?= lang('branch') ?></th>
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