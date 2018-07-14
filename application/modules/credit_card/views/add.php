<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Credit Card / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> Credit Card</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'credit_card'; ?>">Credit Card</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('credit_card/add'); ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-usd"></span> Credit Card</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="credit_card" class="control-label col-md-3">Credit Card</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'credit_card',
                                                        'class'         => 'form-control',
                                                        'id'            => 'credit_card',
                                                        'value'         => set_value('credit_card', $credit_card->credit_card),
                                                        'placeholder'   => 'Credit Card Number',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('credit_card'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="credit_card_amount" class="control-label col-md-3">Credit Card Amount</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'credit_card_amount',
                                                        'class'         => 'form-control',
                                                        'id'            => 'credit_card_amount',
                                                        'value'         => set_value('credit_card_amount', $credit_card->credit_card_amount),
                                                        'placeholder'   => 'Credit Card Amount',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('credit_card_amount'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="payment_amount" class="control-label col-md-3">Credit Card Payment Amount</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'payment_amount',
                                                        'class'         => 'form-control',
                                                        'id'            => 'credit_card_amount',
                                                        'value'         => set_value('40.27', 40.27),
                                                        'placeholder'   => 'Credit Card Payment Amount',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('payment_amount'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->



                                            <div class="box-footer">
                                                <div class="col-md-6 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                                </div>
                                            </div>


                                        </fieldset>
                                        <!--                                   </div>-->
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div>
    </div>
</section>