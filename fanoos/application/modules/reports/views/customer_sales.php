<div class="row">
    <div class="col-md-12">

        <div class="wrap-fpanel">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title"><?= lang('customer_sales') ?> <?= lang('report') ?></h3>
                </div>

                <div class="panel-body">
                    <?= form_open('reports/customerSales', ['class' => 'form-horizontal']) ?>

                    <div class="panel_controls">

                        <div class="form-group margin">
                            <label class="col-sm-3 control-label" for="start-date"><?= lang('from') ?> <span class="required">*</span></label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="start-date" name="start_date" data-date-format="yyyy-mm-dd"
                                           value="<?php if(!empty($start_date)) echo $start_date ?>" autocomplete="off" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="end_date"><?= lang('to') ?> <span class="required">*</span></label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="end_date" name="end_date" data-date-format="yyyy-mm-dd"
                                           value="<?php if(!empty($end_date)) echo $end_date ?>" autocomplete="off" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="customer_id" class="col-sm-3 control-label"><?= lang('customer') ?></label>
                            <div class="col-sm-5">
                                <select name="customer_id" id="customer_id" class="form-control select2">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php if(is_array($customers) && count($customers)): ?>
                                    <?php foreach ($customers as $item): ?>
                                            <option value="<?= $item->id ?>"><?= $item->title ?></option>
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
                            <th colspan="7">
                                <strong><?php if (isset($customer) && !empty($customer)) echo $customer->title; ?></strong>
                            </th>
                        </tr>
                        <tr>
                            <th><?= lang('date') ?></th>
                            <th><?= lang('order_no') ?></th>
                            <th><?= lang('due_date') ?></th>
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
                                    <td><?= dateFormat($item->date) ?></td>
                                    <td><a href="<?= site_url('sales/sale_preview/'.get_orderId($item->id)) ?>"><?= get_orderId($item->id) ?></a></td>
                                    <td><?= dateFormat($item->due_date) ?></td>
                                    <td><?= currency($item->grand_total) ?></td>
                                    <td><?= currency($item->amount_received	) ?></td>
                                    <td><?= currency($item->due_payment) ?></td>
                                </tr>
                                <?php
                                $total_gt += $item->grand_total;
                                $total_rec += $item->amount_received;
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