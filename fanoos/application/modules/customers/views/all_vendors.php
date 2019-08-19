<div class="row">
    <div class="col-md-12">

        <?php echo message_box('success'); ?>
        <?php echo message_box('error'); ?>

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title"><?= lang('vendors') ?></h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->


            <div class="row">
                <div class="col-md-12">
                    <div class="box-body">

                        <div class="mailbox-controls pull-right">
                            <!-- Check all button -->
                            <a href="<?php echo base_url('customers/add_vendor') ?>" class="btn bg-green-active"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('new_vendor') ?></a>

                            <!-- /.pull-right -->
                        </div>

                        <!-- /.mail-box-messages -->
                    </div>
                </div>
            </div>

            <div class="box-body">
                <table id="vendors-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th><?=lang('vendor/company')?></th>
                        <th><?= lang('phone') ?></th>
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