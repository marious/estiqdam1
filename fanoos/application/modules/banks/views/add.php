<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="<?= site_url('banks/add/' . $id); ?>" method="post">
            <?= csrf_field() ?>
            <div class="box box-info">
                <div class="box-body">
                    <!-- account -->
                    <div class="form-group">
                        <label for="account_title" class="col-sm-2 control-label"><?= lang('name') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="account_title" autocomplete="off" class="form-control" name="account_title"
                                   value="<?= set_value('account_title', $account->account) ?>">
                            <?= form_error('account_title', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <?php if (!$id): ?>
                    <!-- initial-balance -->
                    <div class="form-group">
                        <label for="balance" class="col-sm-2 control-label"><?= lang('initial_balance') ?> </label>
                        <div class="col-sm-6">
                            <input type="number" id="balance" autocomplete="off" class="form-control" name="balance"
                                   value="<?= set_value('balance', $account->balance) ?>">
                            <?= form_error('balance', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- account number -->
                    <div class="form-group">
                        <label for="account_number" class="col-sm-2 control-label"><?= lang('account_number') ?> </label>
                        <div class="col-sm-6">
                            <input type="text" id="account_number" autocomplete="off" class="form-control" name="account_number"
                                   value="<?= set_value('account_number', $account->account_number) ?>">
                            <?= form_error('account_number', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- account number -->
                    <div class="form-group">
                        <label for="branch" class="col-sm-2 control-label"><?= lang('branch') ?> </label>
                        <div class="col-sm-6">
                            <input type="text" id="branch" autocomplete="off" class="form-control" name="branch"
                                   value="<?= set_value('branch', $account->branch) ?>">
                            <?= form_error('branch', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- description -->
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label"><?= lang('description') ?> <span class="error"></span></label>
                        <div class="col-sm-6">
                            <textarea name="description" id="description" rows="3" class="form-control"><?= set_value('description', $account->description) ?></textarea>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left"><?= lang('save'); ?></button>
                            <a href="<?= site_url('banks/all') ?>" class="btn btn-default pull-left m-l-10"><?= lang('cancel'); ?></a>

                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
