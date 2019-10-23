<div class="row report-listing">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body">
                <div class="list-group parent-list">
                    <div class="list-group parent-list">
                        <h3 id="right_heading" class="page-header text-info"><i class="icon ti-angle-double-left"></i><?= lang('report_category') ?></h3>

                        <a href="#" class="list-group-item" id="transaction"><?= lang('transaction') ?></a>
                        <a href="#" class="list-group-item" id="sales_purchase"><?= lang('sales') ?></a>
                        <a href="#" class="list-group-item" id="customer"><?= lang('customer') ?></a>

                    </div>
                </div>
            </div>
        </div><!-- ./panel -->
    </div>

    <div class="col-md-6 report-selection">
        <div class="panel">
            <div class="panel-body child-list">
                <h3 id="right_heading" class="page-header text-info"><i class="icon ti-angle-double-left"></i><?= lang('make_a_selection') ?></h3>

                <div class="list-group transaction hidden">
                    <?php if (in_array('show_transactions_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/transaction')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i><?= lang('transaction') ?></a>
                    <?php endif; ?>
                    <?php if (in_array('show_summary_account_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/summaryAccount')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i><?= lang('summary') ?> <?= lang('account') ?> <?= lang('report') ?> </a>
                    <?php endif; ?>
                    <?php if (in_array('show_summary_transactions_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/summaryTransaction')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i><?= lang('summary') ?> <?= lang('transaction') ?> <?= lang('report') ?> </a>
                    <?php endif; ?>
                    <?php if (in_array('show_account_balance_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/BalanceCheck')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('account_balance') ?></a>
                    <?php endif; ?>
                </div>

                <div class="list-group sales_purchase hidden">
                    <?php if (in_array('show_sales_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/salesReport')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i> <?= lang('sales') ?> <?= lang('report') ?></a>
                    <?php endif; ?>
<!--                    <a href="--><?php //echo site_url('reports/returnPurchase')?><!--" class="list-group-item"><i class="icon ti-receipt"></i> --><?//= lang('return_purchase') ?><!--</a>-->
                    <?php if (in_array('show_payment_received_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/paymentReceived')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('payment_received') ?></a>
                    <?php endif; ?>
                </div>

                <div class="list-group customer hidden">
                    <?php if (in_array('show_customer_sales_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/customerSales')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i> <?= lang('customer') ?> <?= lang('sales') ?></a>
                    <?php endif; ?>
                    <?php if (in_array('show_customer_summary_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/customerSummaryReport')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i><?= lang('summary') ?> <?= lang('report') ?></a>
                    <?php endif; ?>
                    <?php if (in_array('show_customer_lifetime_sales_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/customerLifetimeSales')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i> <?= lang('lifetime_sales') ?></a>
                    <?php endif; ?>
                    <?php if (in_array('show_customer_due_payment_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/customerDue')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('due_payment') ?></a>
                    <?php endif; ?>
                    <?php if (in_array('show_customer_over_due_payment_report', $logged_in_user_permissions)): ?>
                    <a href="<?php echo site_url('reports/customerOverDue')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('over_due_payment') ?></a>
                    <?php endif; ?>
                </div>

                <div class="list-group vendor hidden">
                    <a href="<?php echo site_url('reports/vendorPurchaseReport')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i><?= lang('purchase') ?> <?= lang('report') ?></a>
                    <a href="<?php echo site_url('reports/vendorPurchaseDuePayment')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('due_payment') ?></a>
                    <a href="<?php echo site_url('reports/vendorPaymentByDate')?>" class="list-group-item"><i class="icon ti-receipt"></i><?= lang('summary') ?> <?= lang('report') ?></a>
                    <a href="<?php echo site_url('reports/lifetimePurchase')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('lifetime_purchase') ?></a>
<!--                    <a href="--><?php //echo site_url('reports/vendorReturnPurchase')?><!--" class="list-group-item"><i class="icon ti-receipt"></i> --><?//= lang('return_purchase') ?><!--</a>-->
                </div>


                <div class="list-group product hidden">
                    <a href="<?php echo site_url('reports/stockValues')?>" class="list-group-item"><i class="icon ti-bar-chart-alt"></i> <?= lang('stock_values') ?></a>
                    <a href="<?php echo site_url('reports/purchaseReport')?>" class="list-group-item"><i class="icon ti-receipt"></i> <?= lang('product_purchase_report') ?></a>
                    <a href="<?php echo site_url('reports/stockReport')?>" class="list-group-item"><i class="icon ti-receipt"></i><?= lang('stock_report') ?></a>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    $('.parent-list a').click(function(e) {
       e.preventDefault();
       $('.parent-list a').removeClass('active');
       $(this).addClass('active');
       var currentClass = '.child-list .' + $(this).attr('id');
       $('.child-list .page-header').html($(this).html());
       $('.child-list .list-group').addClass('hidden');
       $(currentClass).removeClass('hidden');
       $('#right-heading').addClass('active');
       $('html, body').animate({
           scrollTop: $("#report-selection").offset().top
       }, 500);
    });
</script>