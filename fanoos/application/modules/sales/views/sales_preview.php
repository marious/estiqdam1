<section class="invoice">

    <div class="print-invoice">


        <!-- title -->
        <div class="row">

            <?php echo message_box('success'); ?>
            <?php echo message_box('error'); ?>

            <div class="col-xs-12">
                <h2 class="page-header">
                    <?= setting('company_name')?>
                    <small class="pull-right"><?= lang('date') ?>: <?= date('Y-m-d H:i:s') ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">

            <div class="col-sm-4 invoice-col">
                <?= lang('billing_address') ?>
                <address>
                    <strong><?= $customer->title ?></strong><br>
                    <?= $order->b_address ?><br>
                </address>
            </div>
            <!-- /.col -->
            <?php if($type != 'Quotation'){ ?>
                <div class="col-sm-4 invoice-col">
                    <?= lang('shipping_address') ?>
                    <address>
                        <strong><?= $customer->title ?></strong><br>
                        <?= $order->s_address ?><br>
                    </address>
                </div>
            <?php } ?>
            <!-- /.col -->

            <div class="col-sm-4 invoice-col">
                <?php if($type != 'Quotation'){ ?>
                    <h3><?= setting('invoice_prefix')?><?= INVOICE_PRE + $order->id?></h3><br>
                    <br>
                    <b><?= lang('order_date') ?>:</b> <?php echo $this->localization->dateFormat($order->date, setting('date_format'))?><br>
                    <b><?= lang('payment_due') ?>:</b> <?php echo $this->localization->dateFormat($order->due_date, setting('date_format'))?><br>
                <?php }else{ ?>
                    <h3><?= lang('quotation') ?># <?= INVOICE_PRE + $order->id?></h3><br>
                    <br>
                    <b><?= lang('estimate_date') ?>:</b> <?php echo $this->localization->dateFormat($order->date, setting('date_format'))?><br>
                    <b><?= lang('expiration_date') ?>:</b> <?php echo $this->localization->dateFormat($order->due_date, setting('date_format'))?><br>
                <?php } ?>

                <?php if($order->status === 'Cancel'){ ?>
                    <p class="lead"><?= lang('status') ?>: <span style="color: red"><?= lang('canceled') ?></span></p>
                <?php } ?>

            </div>

        </div>
        <!-- ./row -->

        <!-- Table Row -->
        <div class="row" style="padding-top: 50px">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?= lang('sl') ?>.</th>
                            <th><?= lang('product') ?></th>
                            <th><?= lang('description') ?></th>
                            <th><?= lang('price') ?></th>
                            <th><?= lang('qty') ?></th>
                            <th><?= lang('subtotal') ?> (<?= setting('currency_symbol') ?>)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($order_details as $item): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $item->product_name ?></td>
                            <td><?= $item->description ?></td>
                            <td><?= $item->sales_cost ?></td>
                            <td><?= $item->qty ?></td>
                            <td><?= setting('currency_symbol').' '.$this->localization->currencyFormat($item->sales_cost * $item->qty) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- ./ row -->

        <div class="row">

            <!-- accepted payments column -->

            <div class="col-xs-6">
                <?php if($order->status != 'Cancel'){ ?>
                    <?php if(!empty($order->order_note)){?>
                        <p class="lead"><?= lang('order_note') ?>:</p>
                        <p>
                            <?= $order->order_note ?>
                        </p>
                    <?php };}?>


                <?php if($order->status === 'Cancel'){ if(isset($order->cancel_note)){ ?>
                    <p class="lead"><?= lang('cancellation_note') ?>:</p>
                    <p>
                        <?= $order->cancel_note ?>
                    </p>
                <?php };} ?>

                <?php if($type != 'Quotation'){ ?>
                    <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        <?php echo setting('invoice_text') ?>
                    </div>
                <?php } ?>


            </div>
            <!-- ./col -->

            <!-- /. col -->
            <div class="col-xs-6">

                <?php if($type != 'Quotation'){ ?>
                    <p class="lead"><?= lang('amount_due') ?>: <?= setting('currency_symbol').' '.$this->localization->currencyFormat($order->due_payment) ?></p>
                <?php } ?>

                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%"><?= lang('subtotal') ?>:</th>
                            <td><?= setting('currency_symbol').' '.$this->localization->currencyFormat($order->cart_total) ?></td>
                        </tr>
                        <?php if($type != 'Quotation'){ ?>
                            <tr>
                                <th><?= lang('tax') ?>:</th>
                                <td><?= setting('currency_symbol').' '.$this->localization->currencyFormat($order->tax) ?></td>
                            </tr>
                            <?php $discount_amount = ($order->cart_total * $order->discount)/100; ?>
                            <tr>
                                <th><?= lang('discount') ?>:</th>
                                <td><?= setting('currency_symbol').' - '.$this->localization->currencyFormat($discount_amount) ?> (<?= $order->discount?>%)</td>
                            </tr>
                            <tr>
                                <th><?= lang('grand_total') ?>:</th>
                                <td><?= setting('currency_symbol').' '.$this->localization->currencyFormat($order->grand_total) ?></td>
                            </tr>
                            <tr>
                                <th><?= lang('received_amount') ?> :</th>
                                <td><?= setting('currency_symbol').' '.$this->localization->currencyFormat($order->amount_received) ?></td>
                            </tr>
                            <tr>
                                <th><?= lang('amount_due') ?> :</th>
                                <td><?= setting('currency_symbol').' '.$this->localization->currencyFormat($order->due_payment) ?></td>
                            </tr>
                        <?php } ?>
                        </tbody></table>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <!-- ./row -->

    </div>


    <?php if(!empty($payment)){ ?>
        <table class="table table-bordered">
            <thead>
            <tr class="info">
                <th><?= lang('date') ?></th>
                <th><?= lang('payment_ref') ?></th>
                <th><?= lang('payment_method') ?></th>
                <th><?= lang('amount') ?></th>
                <th><?= lang('received_by') ?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($payment as $id){ ?>
                <tr>
                    <td><?php echo date(setting('date_format'), strtotime($id->payment_date)); ?></td>
                    <td><?php echo $id->order_ref ?></td>
                    <td><?php echo $id->payment_method ?></td>
                    <td><?php echo currency($id->amount) ?></td>
                    <td><?php echo $id->received_by ?></td>
                </tr>
            <?php }?>

            </tbody>
        </table>
    <?php } ?>

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a id="printButton" class="btn btn-default"><i class="fa fa-print"></i> <?= lang('print') ?></a>

            <a onclick="return confirm('Are you sure want to delete this Invoice ?');" href="<?php echo base_url()?>admin/sales/deleteInvoice/<?php echo get_orderID($order->id) ?> " class="btn btn-danger pull-right" style="margin-right: 5px;">
                <i class="fa fa-trash"></i> <?= lang('delete') ?>
            </a>

            <?php if($type != 'Quotation'){ ?>
                <a href="<?php echo base_url()?>admin/sales/cancelSales/<?php echo get_orderID($order->id) ?> " data-target="#modalSmall" data-toggle="modal" class="btn btn-warning pull-right" style="margin-right: 5px;">
                    <i class="fa fa-close"></i> <?= lang('cancel') ?>
                </a>

                <a href="<?php echo base_url()?>sales/paymentList/<?php echo get_orderID($order->id) ?> " data-target="#myModal" data-toggle="modal" class="btn bg-olive pull-right" style="margin-right: 5px;">
                    <i class="fa fa-money"></i> <?= lang('view_payment') ?>
                </a>

                <a href="<?php echo base_url()?>sales/add_payment/<?php echo get_orderID($order->id) ?> " data-target="#modalSmall" data-toggle="modal" class="btn bg-purple pull-right" style="margin-right: 5px;">
                    <i class="fa fa-money"></i> <?= lang('add_payment') ?>
                </a>
            <?php } ?>

        </div>
    </div>


</section>