<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">

                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href=""><?= lang('all_cancel_contracts'); ?></a>
                            </li>
                            <li>
                                <a href="<?= site_url('services_entry/advanced_search'); ?>">
                                    <?= lang('cancel_contract'); ?>
                                </a>
                            </li>
                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('services'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>

                                        <?php if (isset($contracts) && count($contracts)): ?>
                                        <table id="services_table"
                                               class="table table-bordered table-striped services-table">
                                            <thead>
                                            <tr>
                                                <th>الرقم</th>
                                                <th>اسم العميل</th>
                                                <th>رقم التأشيرة</th>
                                                <th>وكيل الاستقدام</th>
                                                <th>السبب</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($contracts as $contract): ?>
                                                <tr>
                                                    <td><?= $contract->contract_number; ?></td>
                                                    <td><?= $contract->customer_name_in_arabic; ?></td>
                                                    <td><?= $contract->visa_number; ?></td>
                                                    <td><?= $contract->representative_name ?></td>
                                                    <td><?= $contract->reason; ?></td>

                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php  endif; ?>


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
