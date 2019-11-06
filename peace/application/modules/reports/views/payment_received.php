<div class="row">
    <div class="col-md-12">

        <div class="wrap-fpanel">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title"><?= lang('payment_received') ?></h3>
                </div>

                <div class="panel-body">
                    <?= form_open('reports/paymentReceived', ['class' => 'form-horizontal']) ?>

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
                            <th><?= lang('date') ?></th>
                            <th><?= lang('order_no') ?></th>
                            <th><?= lang('amount') ?></th>
                            <th><?= lang('payment_method') ?></th>
                            <th><?= lang('received_by') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_gt = 0;
                        ?>
                        <?php if (isset($invoice) && is_array($invoice) && count($invoice)): ?>

                            <?php foreach ($invoice as $item): ?>
                                <tr>
                                    <td><?= dateFormat($item->payment_date) ?></td>
                                    <td><a href="<?= site_url('sales/sale_preview/'.get_orderId($item->id)) ?>"><?= get_orderId($item->id) ?></a></td>
                                    <td><?= currency($item->amount) ?></td>
                                    <td><?= $item->payment_method ?></td>
                                    <td><?= $item->received_by ?></td>
                                </tr>
                                <?php
                                $total_gt += $item->amount;
                                ?>
                            <?php endforeach; ?>
                            <tr>
                                <td style="background-color: #e7e7e7"></td>
                                <td style="background-color: #e7e7e7"></td>
                                <td style="background-color: #e7e7e7"><strong>= <?= currency($total_gt)?></strong></td>
                                <td style="background-color: #e7e7e7"></td>
                                <td style="background-color: #e7e7e7"></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
</div>