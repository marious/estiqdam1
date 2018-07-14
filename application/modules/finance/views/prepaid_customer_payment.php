<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header"></div>

                <div class="page-content-wrapper">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-search"></span> <?= lang('advanced_search'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t services-entry-form">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <form action="">

                                        <div id="advanced-search-entry">
                                            <div class="col-md-4">
                                                <label for="searched_query"><?= lang('enter_customer_visa') ?> <span class="enter-keyword"></span></label>
                                                <input type="text" class="form-control" name="visa_number" id="searched_query" autocomplete="off" value="<?php if (isset($_GET['visa_number']) && !empty($_GET['visa_number']))  { echo $_GET['visa_number']; }?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-block"><?= lang('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div><!-- ./block-content -->
                </div><!-- ./page-content -->

                <?php if (isset($customer) && count($customer)) { ?>

                    <div class="panel panel-default m-t">
                        <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('services'); ?></div>
                        <div class="panel-body">
                            <div class="tab-content m-t">
                                <?php if ($customer_payment->remains_money != 0): ?>
                                    <div class="pull-right" style="margin-bottom: 10px;"><a href="<?= site_url('finance/add_new_payment/' . $customer->contract_number); ?>" target="_blank" class="btn btn-success">عملية دفع جديدة</a></div>
                                <?php endif; ?>
                                <?php if ( count($customer_payment_data) && count($customer_payment_data) ) { ?>
                                    <form method="post" action="<?= site_url("finance/save_prepaid_customer_payment"); ?>">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>اسم العميل</th>
                                            <th>رقم الفيزا</th>
                                            <th>رقم سند الدفع</th>
                                            <th>اجمالى مبلغ الاستقدام</th>
                                            <th>إجمالى المدفوع</th>
                                            <th>إجمالى المتبقى</th>
                                            <th>المدفوع لهذا السند</th>
                                            <th>نوع الدفع</th>
                                            <th>تاريخ الدفع</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="payment_data">
                                        <?php foreach ($customer_payment_data as $payment_info): ?>
                                        <tr>
                                            <td><?= $customer->customer_name_in_arabic; ?></td>
                                            <td><?= $customer->visa_number; ?></td>
                                            <td><?= $payment_info->payment_number; ?></td>
                                            <td><?= $customer_payment->recruitment_cost; ?></td>
                                            <td><?= $customer_payment->prepaid_money; ?></td>
                                            <td><?= $customer_payment->remains_money; ?></td>
                                            <td><?= $payment_info->payment_amount; ?></td>
                                            <td>
                                                <?php
                                                $this->load->module('transfer_types');
                                                $transfer_type = '';
                                                $category_type = '';
                                                if ($payment_info->transfer_type != 0)
                                                {
                                                    $type = $this->transfer_types->Transfer_type_model->get_by(array('id' => $payment_info->transfer_type), true);
                                                    $transfer_type = $type->type;
                                                    if ($type->parent_id != 0)
                                                    {
                                                        $category_type = ' - ' . $this->transfer_types->get_type_by_id($type->parent_id) ;
                                                    }
                                                }
                                                ?>
                                                <?php echo $transfer_type . $category_type; ?>
                                            </td>
                                            <td class="payment_date" data-type="date" data-name="payment_date" data-pk="<?= $payment_info->payment_number ?>"><?= date('d-m-Y', strtotime($payment_info->payment_date)); ?></td>
                                            <td>
                                                <a target="_blank" href="<?= site_url('finance/print_payment_band/' . $_GET['visa_number']) . '/' . $payment_info->payment_number ?>" class="btn btn-sm btn-success">طباعة السند</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <input type="hidden" name="visa_number" value="<?= $customer->visa_number; ?>">
                                </form>
                                <?php } ?>

                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                <div class="panel panel-default m-t">
                    <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('services'); ?></div>
                    <div class="panel-body">
                        <div class="tab-content m-t">
                            <?php if (isset($_GET['visa_number'])): ?>
                            <h2>عذرا لم يتم العثور على أى بيانات تخص هذا الرقم</h2>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>


            </div>
        </div>
    </div>
</section>