<div class="row">
    <div class="col-md-12">

        <!-- View massage -->
        <?php echo message_box('success'); ?>
        <?php echo message_box('error'); ?>

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">
                    <?= lang('create_purchase') ?>
                </h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <?php echo $form->open(); ?>

            <div class="box-body">
                <!-- View massage -->
                <?php echo $form->messages(); ?>


                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <div id="msg"></div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="row">
                                    <?php if (empty($order)): ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('vendor') ?> <span class="required" aria-required="true">*</span></label>
                                            <select class="form-control select2" style="width: 100%" onchange="getVendor(this)" name="vendor_id">
                                                <option value=""><?= lang('please_select') ?>...</option>
                                                <?php if(!empty($vendors)){ foreach ($vendors as $item){ ?>
                                                    <option value="<?php echo $item->id ?>" <?php echo  $v_detail->id == $item->id ? 'selected':'' ?>><?php echo 100+$item->id.'-'. $item->company_name ?></option>
                                                <?php };} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <div class="col-md-6">
                                            <!-- /.Start Date -->
                                            <div class="form-group form-group-bottom">
                                                <label><?= lang('customer') ?></label>
                                                <input type="text" class="form-control" value="<?php echo $v_detail->name ?>" readonly >
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-md-6">
                                        <!-- /.Start Date -->
                                        <div class="form-group form-group-bottom">
                                            <label><?= lang('email') ?></label>
                                            <input type="text" name="email" class="form-control" value="<?php echo $v_detail->email ?>" >
                                        </div>
                                    </div>
                                    <?php $address = nl2br($v_detail->b_address) ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('billing_address') ?></label>
                                            <textarea class="form-control" name="b_address"><?php echo $v_detail->b_address ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('billing_ref') ?>.</label>
                                            <input class="form-control" type="text" name="bill_ref">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <?php if(!empty($order)): ?>
                            <div class="col-md-6">
                                <div class="row" style="padding-left: 70px">
                                    <div class="col-md-12">
                                        <h3>Quotation# <?= INVOICE_PRE + $order->id?></h3><br>
                                        <b>Estimate date:</b> <?php echo $this->localization->dateFormat($order->due_date)?><br>
                                        <b>Expiration date:</b> <?php echo $this->localization->dateFormat($order->due_date)?><br>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="box">
                            <div class="box-body">
                                <div id="cart-view">
                                    <?php $this->load->view('add_product_cart') ?>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?= lang('note') ?></label>
                                            <textarea class="form-control" name="order_note"><?php if(!empty($order))echo $order->order_note ?></textarea>
                                        </div>
                                    </div>
                                </div>




                                <button type="submit" class="btn bg-navy btn-flat" id="save-invoice" disabled><?= lang('save'); ?> </button>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- /.box-body -->


            <?php echo $form->close(); ?>

        </div>

    </div>
</div>