<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('customers_not_paid_remains_report'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> <?= lang('customers_not_paid_remains_report'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table id="finance_table_2" class="table table-bordered table-striped services-table">
                                        <thead>
                                        <tr>
                                            <th><?= lang('contract_number') ?></th>
                                            <th><?= lang('contract_date') ?></th>
                                            <th><?= lang('customer_name') ?></th>
                                            <th><?= lang('customer_mobile') ?></th>
                                            <th>
                                                <select name="country" id="country" style="width: 145px;">
                                                    <option value="">كل الدول</option>
                                                    <?php
                                                    foreach ($countries as $country) {
                                                        echo '<option value="'.$country->id.'">'.$country->country_name_in_arabic.'</option>';
                                                    }
                                                    ?>
                                            </th>
                                            <th><?= lang('recruitment_cost'); ?></th>
                                            <th><?= lang('prepaid_money'); ?></th>
                                            <th><?= lang('remains'); ?></th>
                                        </tr>
                                        </thead>
                                    </table>
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