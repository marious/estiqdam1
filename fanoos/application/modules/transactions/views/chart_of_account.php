<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('chart_account_list') ?></h3>
                <div class="box-tools" style="padding-top: 5px">
                    <div class="input-group input-group-sm" >
                        <a  data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
                            href="<?php echo base_url()?>transactions/add_account" class="btn bg-blue-active btn-sm btn-flat">
                            <i class="fa fa-plus"></i> <?= lang('new_account') ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="box-body">
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><?= lang('name') ?></th>
                            <th><?= lang('description') ?></th>
                            <th><?= lang('account_type') ?></th>
                            <th><?= lang('balance') ?></th>
                            <th><?= lang('actions') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (is_array($account_head) && count($account_head)): ?>
                    <?php foreach ($account_head as $account): ?>
                        <tr>
                            <td>
                                <a href="<?= site_url('transactions/view_transaction/'.str_replace(['+','/','='], ['-', '_', '~'], $this->encryption->encrypt('account-'.$account->id))) ?>">
                                    <?= $account->account_title ?>
                                </a>
                            </td>
                            <td>
                                <?= $account->description ?>
                            </td>
                            <td>
                                <?= $account->account_type ?>
                            </td>
                            <td>
                                <?= $account->balance ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>

                </table>

            </div>

        </div><!-- ./box-primary -->
    </div>
</div>