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
                                <a href="">كل العقود الملغاة تفويضا</a>
                            </li>
                            <li>
<!--                                <a href="--><?//= site_url('services_entry/advanced_search'); ?><!--">-->
<!--                                    إضافة جديد-->
<!--                                </a>-->
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
                                                <th>التاريخ</th>
                                                <th>اسم العميل</th>
                                                <th>رقم التأشيرة</th>
                                                <th>وكيل الاستقدام</th>
                                                <th>نوع الطلب</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($contracts as $contract): ?>
                                                <tr>
                                                    <td><?= $contract->contract_number; ?></td>
                                                    <td><?= date('j-m-Y', strtotime($contract->contract_date)); ?></td>
                                                    <td><?= $contract->customer_name_in_arabic; ?></td>
                                                    <td><?= $contract->visa_number; ?></td>
                                                    <td><?= $contract->representative_name ?></td>
                                                    <td><?= $contract->order_name_arabic; ?></td>
                                                    <td>


                                                        <div class="btn-group">
                                                            <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                                                            </button>
                                                            <ul class="datatable-dropdown dropdown-menu icons-left" role="menu">
                                                                <li><a href="<?= site_url('services_entry/print_cancel_delegation/' . $contract->contract_number); ?>" class="tips " title=""  target="_blank">
                                                                        <i class="glyphicon glyphicon-print"></i>  طباعة الالغاء </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?= site_url('services_entry/make_confirm_contract/' . $contract->contract_number); ?>">
                                                                        عمل عقد تصديق
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </td>
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
