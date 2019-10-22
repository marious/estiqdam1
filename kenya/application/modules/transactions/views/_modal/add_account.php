<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= lang('add_new_account') ?></h4>
</div>

<div class="modal-body">
    <?= form_open('transactions/save_new_account', ['id' => 'new-account']) ?>
        <div class="form-group">
            <label for="account_title"><?= lang('account_name') ?><span
                    class="required"> *</span></label>
            <input type="text" id="account_title" name="account_title" value="<?php if(!empty($account)) echo $account->account_title ?>"
                   class="form-control" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="account_nmber"><?= lang('account_number') ?><span
                    class="required"> *</span></label>
            <input type="text" id="account_nmber" name="account_number" value="<?php if(!empty($account)) echo $account->account_number ?>"
                   class="form-control" autocomplete="off">
        </div>

        <?php if (MULTI_CURRENCY): ?>
            <div class="form-group">
                <label for="account_currency"><?= lang('account_currency') ?><span
                            class="required"> *</span></label>
                <select class="form-control select2" style="width: 100%;" name="account_currency">
                    <?php foreach ($countries as $item) : ?>
                        <?php
                    $selected = '';
                    if (empty($account->account_currency)) {
                        $selected = setting('default_currency') == $item->currency_code . '-' . $item->country ? 'selected' : '';
                    } else {
                        $selected = $account->account_currency == $item->currency_code . '-' . $item->country ? 'selected' : '';
                    }
                        ?>
                        <option value="<?php echo $item->currency_code . '-' . $item->country ?>" <?= $selected ?>>
                            <?php echo $item->currency_code .' - '. $item->country  ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="description"><?= lang('description') ?><span
                    class="required"> *</span></label>
            <input type="text" name="description" id="description" value="<?php if(!empty($account)) echo $account->description ?>"
                   class="form-control" autocomplete="off">
        </div>

    <div class="form-group">
        <label for="balance"><?= lang('balance') ?></label>
        <input type="text" id="balance" name="balance" value="<?php if(!empty($account)) echo $account->balance ?>"
               class="form-control" autocomplete="off" <?php if (!empty($account)) echo 'readonly'; ?>>
    </div>


    <?php if (!empty($account)): ?>
        <input type="hidden" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encryption->encrypt($account->id)) ?>" name="id">
    <?php endif; ?>

    <span class="required">*</span> <?= lang('required_field') ?>

    <div class="modal-footer" >

        <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><?= lang('close') ?></button>
        <button type="submit" class="btn bg-olive btn-flat" id="btn" ><?= lang('save') ?></button>


    </div>

    <?= form_close() ?>
</div>