<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('chart_account_list') ?></h3>
                <div class="box-tools" style="padding-top: 5px">
                    <div class="input-group input-group-sm" >
                        <?php if (in_array('add_account', $logged_in_user_permissions)): ?>
                        <a  data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
                            href="<?php echo base_url()?>transactions/add_account" class="btn bg-blue-active btn-sm btn-flat">
                            <i class="fa fa-plus"></i> <?= lang('new_account') ?>
                        </a>
                        <?php endif; ?>
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
                            <?php if (MULTI_CURRENCY): ?>
                            <th><?= lang('currency') ?></th>
                            <?php endif; ?>
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
                            <?php if (MULTI_CURRENCY): ?>
                                <td>
                                    <?= $account->account_currency ? $account->account_currency : setting('default_currency') ?>
                                </td>
                            <?php endif; ?>
                            <td>
                                <?= $account->balance ?>
                            </td>
                            <td>
                                <?php if ($account->sys): ?>
                                <div class="btn-group">

                                    <?php if (in_array('edit_account', $logged_in_user_permissions)): ?>
                                    <a data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
                                       class="btn btn-xs btn-default" href="<?php echo base_url()?>transactions/edit_account/<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encryption->encrypt($account->id))?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <?php endif; ?>

                                    <?php if (in_array('delete_account', $logged_in_user_permissions)): ?>
                                    <a class="btn btn-xs btn-danger" onClick="return confirm('Are you sure you want to delete?')"
                                       href="<?php echo site_url('transactions/delete_account/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encryption->encrypt($account->id))) ?>">
                                        <i class="glyphicon glyphicon-trash"></i></a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
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