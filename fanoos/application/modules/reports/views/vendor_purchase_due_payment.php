<div class="row">
    <div class="col-md-12">

        <div class="wrap-fpanel">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title"><?= lang('payment_due') ?> <?= lang('report') ?></h3>
                </div>

                <div class="panel-body">
                    <?= form_open('reports/vendorPurchaseDuePayment', ['class' => 'form-horizontal']) ?>

                    <div class="panel_controls">


                        <div class="form-group">
                            <label for="vendor_id" class="col-sm-3 control-label"><?= lang('vendor') ?></label>
                            <div class="col-sm-5">
                                <select name="vendor_id" id="vendor_id" class="form-control select2">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php if(is_array($vendors) && count($vendors)): ?>
                                        <?php foreach ($vendors as $item): ?>
                                            <option value="<?php echo $item->id ?>" >
                                                <?php echo $item->company_name ?>
                                            </option>
                                        <?php  endforeach; ?>
                                    <?php  endif; ?>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('submit') ?></button>
                            </div>
                        </div>


                    </div>

                    <input type="hidden" name="flag" value="1">
                    <?= form_close() ?>

                    <table class="table table-striped table-bordered display-all" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th colspan="6">
                                <strong><?php if (isset($vendor) && !empty($vendor)) echo $vendor->name . ' - ' . $vendor->company_name; ?></strong>
                            </th>
                        </tr>
                        <tr>
                            <th><?= lang('date') ?></th>
                            <th><?= lang('purchase_no') ?></th>
                            <th><?= lang('vendor') ?></th>
                            <th><?= lang('grand_total') ?></th>
                            <th><?= lang('paid') ?></th>
                            <th><?= lang('balance') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_gt = 0;
                        $total_rec = 0;
                        $total_due = 0;
                        ?>
                        <?php if (isset($invoice) && is_array($invoice) && count($invoice)): ?>

                            <?php foreach ($invoice as $item): ?>
                                <tr>
                                    <td><?= dateFormat($item->created_at) ?></td>
                                    <td><a href="<?= site_url('purchase/purchase_invoice/'.get_orderId($item->id)) ?>"><?= get_orderId($item->id) ?></a></td>
                                    <td><?= $item->vendor_name ?></td>
                                    <td><?= currency($item->grand_total) ?></td>
                                    <td><?= currency($item->paid_amount) ?></td>
                                    <td><?= currency($item->due_payment) ?></td>
                                </tr>
                                <?php
                                $total_gt += $item->grand_total;
                                $total_rec += $item->paid_amount;
                                $total_due += $item->due_payment;
                                ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            <td style="background-color: #e7e7e7"></td>
                            <td style="background-color: #e7e7e7"></td>
                            <td style="background-color: #e7e7e7"></td>
                            <td style="background-color: #e7e7e7"><strong>= <?= currency($total_gt)?></strong></td>
                            <td style="background-color: #e7e7e7"><strong>= <?= currency($total_rec)?></strong></td>
                            <td style="background-color: #e7e7e7"><strong>= <?= currency($total_due)?></strong></td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
</div>