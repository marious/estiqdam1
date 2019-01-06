<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Help Payments</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Help Payment</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <form action="" class="form-horizontal" method="get">
                                        <div class="col-md-4">
                                            <label for="" class="control-label col-md-2"><?= lang('when'); ?></label>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class='input-group date' id='dateyearpicker'>
                                                        <input type='text' class="form-control" name="daterange" value="<?php if (isset($_GET['daterange']) && $_GET['daterange'] != '') { echo $_GET['daterange']; } ?>">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar">
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- ./ col-md-3 -->


                                        <div class="col-md-2">
                                            <button class="btn btn-primary" type="submit"><?= lang('search') ?></button>
                                        </div><!-- ./ col-md-3 -->

                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('result'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">

                                    <?php if ($payments && count($payments)): ?>
                                    <table class="table table-bordred table-striped">
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>التاريخ</th>
                                            <th>لمبلغ</th>
                                            <th>طريقة الدفع</th>
                                            <th>ملاحظات</th>
                                        </tr>
                                        <?php $amount = 0; $i = 1; foreach ($payments as $payment): ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $payment->customer_name_in_arabic; ?></td>
                                            <td><?= $payment->payment_date; ?></td>
                                            <td><?= $payment->payment_amount; ?></td>
                                            <td><?= $payment->type; ?></td>
                                            <td><?php echo "مدفوعات: {$payment->customer_name_in_arabic}"; ?></td>
                                        </tr>
                                        <?php $amount += $payment->payment_amount; ?>
                                        <?php $i++; endforeach; ?>
                                        <tr>
                                            <td rowspan="2"><?= $amount; ?></td>
                                        </tr>
                                    </table>
                                    <?php endif; ?>

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

