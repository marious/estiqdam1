<section class="invoice">
    <div class="print-invoice">
        <!--  view message  -->
        <?= message_box('success') ?>
        <?= message_box('error') ?>


        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <?= setting('company_name')?>
                    <small class="pull-right"><?= lang('date') ?>: <?= $order->created_at ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>

        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <?= lang('billing_address') ?>
                <address>
                    <strong><?= $vendor->company_name ?></strong><br>
                    <?= $order->b_address ?><br>
                    <?= lang('phone') ?>: <?= $vendor->phone ?><br>
                    <?= lang('email') ?>: <?= $order->email ?>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">

            </div>
            <div class="col-sm-4 invoice-col">
                <h3><?= setting('order_prefix')?><?= INVOICE_PRE + $order->id?></h3><br>
                <b><?= lang('order_date') ?>:</b> <?php echo $this->localization->dateFormat($order->created_at)?><br>
                <b><?= lang('billing_ref') ?>:</b> <?php echo $order->ref ?><br>
            </div>
        </div>

        <div class="row" style="padding-top: 50px">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <th><?= lang('sl') ?>.</th>
                    <th><?= lang('product') ?></th>
                    <th><?= lang('description') ?></th>
                    <th><?= lang('price') ?></th>
                    <th><?= lang('qty') ?></th>
                    <th><?= lang('subtotal') ?> (<?= setting('currency_symbol') ?>)</th>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($order_details as $item): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $item->product_name ?></td>
                        <td><?= $item->description ?></td>
                        <td><?= $item->unit_price ?></td>
                        <td><?= $item->qty ?></td>
                        <td><?= $this->localization->currencyFormat($item->sub_total) ?></td>
                    </tr>
                    <?php $i++; endforeach;?>

                    <?php if (is_array($return) && count($return)): ?>
                        <?php $total_return = 0; ?>
                        <tr class="warning">
                            <td colspan="6"><strong><?= lang('returned_items') ?></strong></td>
                        </tr>
                        <?php foreach ($return as $item): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $item->product_name ?></td>
                                <td><?= $item->description ?></td>
                                <td><?= $item->unit_price ?></td>
                                <td><?= '-'.$item->qty ?></td>
                                <td><?= '-'. $this->localization->currencyFormat($item->sub_total) ?></td>
                            </tr>
                        <?php $total_return += $item->sub_total ?>
                        <?php $i++; endforeach; ?>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-7">
                <?php if (!empty($order->order_note)): ?>
                    <p class="lead"><?= lang('order_note') ?>:</p>
                    <p>
                        <?= $order->order_note ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="col-xs-5">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%"><?= lang('subtotal') ?>:</th>
                                <td><?= $this->localization->currencyFormat($order->cart_total) ?></td>
                            </tr>

                        <?php if (!empty($return)): ?>
                            <th style="width:50%"><?= lang('total_return') ?>:</th>
                            <td>- <?= $this->localization->currencyFormat($total_return) ?></td>
                        <?php endif; ?>

                            <tr>
                                <th><?= lang('discount') ?>:</th>
                                <td>- <?= $this->localization->currencyFormat($order->discount) ?></td>
                            </tr>

                            <tr>
                                <th><?= lang('tax_amount') ?>:</th>
                                <td><?= $this->localization->currencyFormat($order->tax) ?></td>
                            </tr>
                            <tr>
                                <th><?= lang('shipping') ?>:</th>
                                <td><?= $this->localization->currencyFormat($order->shipping) ?></td>
                            </tr>
                            <tr>
                                <th><?= lang('grand_total') ?>:</th>
                                <td><?= $this->localization->currencyFormat($order->grand_total) ?></td>
                            </tr>
                            <tr>
                                <th><?= lang('paid') ?> :</th>
                                <td><?= $this->localization->currencyFormat($order->paid_amount) ?></td>
                            </tr>
                            <tr>
                                <th><?= lang('balance') ?> :</th>
                                <td><?= $this->localization->currencyFormat($order->due_payment) ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>


    <?php if (is_array($payment) && count($payment)): ?>
    <table class="table table-bordered">
        <thead>
            <tr class="info">
                <th><?= lang('date') ?></th>
                <th><?= lang('payment_ref') ?>.</th>
                <th><?= lang('payment_method') ?></th>
                <th><?= lang('amount') ?></th>
                <th><?= lang('received_by') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($payment as $id): ?>
            <tr>
                <td><?php echo date(setting('date_format'), strtotime($id->payment_date)); ?></td>
                <td><?php echo $id->order_ref ?></td>
                <td><?php echo $id->payment_method ?></td>
                <td><?php echo currency($id->amount) ?></td>
                <td><?php echo $id->received_by ?></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>


    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a id="printButton" class="btn btn-default"><i class="fa fa-print"></i> <?= lang('print') ?></a>
            <?php if ($order->type != 'Return'): ?>
                <a href="<?php echo base_url()?>purchase/add_payment/<?php echo get_orderID($order->id) ?> " data-target="#modalSmall" data-toggle="modal" class="btn bg-purple pull-right" style="margin-right: 5px;">
                    <i class="fa fa-money"></i> <?= lang('add_payment') ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

</section>