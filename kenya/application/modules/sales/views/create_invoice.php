<div class="row">
    <div class="col-md-12">



        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= isset($order) ? lang('update_sales_invoice') : lang('create_sales_invoice') ?></h3>
            </div>
            <!-- /.box-header -->

            <?= $form->open() ?>

            <div class="box-body">
                <!-- View massage -->
                <?php echo $form->messages(); ?>
                <!-- view message -->
                <?= message_box('success') ?>
                <?= message_box('error') ?>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <div id="msg"></div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (!isset($order)): ?>
                                        <div class="form-group">
                                            <label for="customers-list"><?= lang('customer') ?> <span class="required" aria-required="true">*</span></label>
                                            <select name="customer_id" class="form-control select2" style="width: 100%" id="customers-list">
                                                <option value=""><?= lang('please_select') ?>...</option>
                                            </select>
                                        </div>
                                        <?php else: ?>
                                            <div class="form-group form-group-bottom">
                                                <label><?= lang('customer') ?></label>
                                                <input type="text" class="form-control" value="<?php echo $customer->title ?>" readonly>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><?= lang('terms') ?></label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-default pull-left" id="daterange-btn">
                                            <span>
                                              <i class="fa fa-calendar"></i> <?= lang('payment_term') ?>
                                            </span>
                                                    <i class="fa fa-caret-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    if (isset($order)) {
                                        $invoice_date = date('d/m/Y', strtotime($order->invoice_date));
                                        $due_date = date('d/m/Y', strtotime($order->due_date));
                                    } else {
                                        $invoice_date = date('d/m/Y');
                                        $due_date = date('d/m/Y');
                                    }
                                    ?>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?= lang('invoice_date') ?> <span class="required"
                                                                                     aria-required="true">*</span></label>
                                            <input name="invoice_date" class="form-control invoice_date datepicker"
                                                   type="text" id="datepicker" data-date-format="dd/mm/yyyy"  value="<?php echo $invoice_date ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?= lang('due_date') ?><span class="required" aria-required="true">*</span></label>
                                            <input name="due_date" class="form-control due_date datepicker"
                                                   id="datepicker-1" type="text" data-date-format="dd/mm/yyyy"
                                                   value="<?php echo $due_date ?>">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>




                    </div>
                </div>
                <!-- ./row -->

                <div class="box">
                    <div class="box-body">
                        <div id="cart-view">
                            <?php $this->load->view('add_product_cart') ?>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label for=""><?= lang('order_note') ?></label>
                                <textarea class="form-control" name="order_note"></textarea>
                            </div>

                        </div>
                    </div>
                </div>



                <?php if (empty($order)): ?>
                <div class="box">
                    <div class="box-body">
                        <div id="cart-view">
                            <?php $this->load->view('payment_view') ?>
                        </div>
                        <div class="row"></div>
                    </div>
                </div>
                <?php endif; ?>


                <button type="submit" class="btn bg-navy btn-flat" id="saveInvoice" ><?= lang('save'); ?> </button>

            </div>
            <!-- ./box-body -->





        </div>


        <input type="hidden" name="type" value="<?= !empty($type) ? $type : '' ?>">
        <input type="hidden" name="order_id" value="<?php if (!empty($order)) echo str_replace(['+', '/', '='],['-', '_', '~'],
            $this->encryption->encrypt($order->id)) ?>">

        <?= $form->close() ?>



    </div>
</div>