<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?php echo $title ?></h3>
            </div>

            <div class="box-body">

                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>


                <div class="row">
                    <div class="col-md-12">

                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <th><?= lang('trns_id') ?></th>
                            <?php if ($column != 'account_id'): ?>
                                <th><?= lang('account') ?></th>
                            <?php endif; ?>
                            <?php if($column != 'transaction_type_id'): ?>
                                <th><?= lang('type') ?></th>
                            <?php endif; ?>
                            <?php if($column != 'category_id'): ?>
                                <th><?= lang('category') ?></th>
                            <?php endif; ?>
                                <th><?= lang('dr') ?>.</th>
                                <th><?= lang('cr') ?>.</th>
                                <th><?= lang('balance') ?></th>
                                <th><?= lang('date') ?></th>
                                <th style="width:25px;"><?= lang('actions') ?></th>
                            </thead>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    let list = 'transactions/transaction_view/<?php echo $column . '-' . $id ?>';
</script>