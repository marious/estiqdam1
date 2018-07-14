    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="content">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 pull-right"> <h3 class="page-title ">التقرير اليومى ليوم <?= date('Y-m-d', strtotime($contract_date)); ?></h3></div>
                            <div class="col-md-6 pull-left">
                                <form class="form-inline" style="margin-top: 10px;">
                                    <div class="form-group">
                                        <label for="contract_date">تاريخ العقد</label>
                                        <input type="text" name="contract_date" class="form-control datepicker" id="contract_date" placeholder="تاريخ العقد">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><?= lang('search'); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- page header -->
                    <div class="page-content-wrapper m-t">
                        <div class="block-content">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="<?= site_url('services_entry'); ?>"><?= lang('today_contracts'); ?></a>
                                </li>
                                <li class="">
                                    <a href="<?= base_url() . 'services_entry/add'; ?>"><?= lang('add_new_service'); ?></a>
                                </li>
                                <li>
                                    <a href="<?= site_url('services_entry/customer_worker_contract') ?>">Auto Contract</a>
                                </li>
                                <li>
                                    <a href="<?= site_url('services_entry/advanced_search'); ?>">
                                        <?= lang('advanced_search'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= site_url('services_entry/processing_list'); ?>">
                                        <?= lang('processing'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= site_url('services_entry/cancel_delegation') ?>">التفويض الملغى</a>
                                </li>
                                <li>
                                    <a href="<?= site_url('services_entry/cancel_contract'); ?>"><?= lang('cancel_contract'); ?></a>
                                </li>

                            </ul>

                            <div class="panel panel-default m-t">
                                <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('services'); ?></div>
                                <?php if ($services && count($services)): ?>
                                <?php
                                    $contract_date = isset($_GET['contract_date']) ? $_GET['contract_date'] : date('d-m-Y');
                                    ?>
                                <div class="pull-right"><a target="_blank" href="<?= site_url('services_entry/print_daily_reports?contract_date=' . $contract_date); ?>" class="btn btn-success">طباعة التقرير اليومى</a></div>
                                <br>
                                <?php endif; ?>
                                <div class="panel-body">
                                    <div class="tab-content m-t">
                                        <?php $this->load->view('includes/flash_messages'); ?>
                                        <?php if ($services && count($services)): ?>
                                            <table id="services_table" class="table table-bordered table-striped services-table">
                                                <thead>
                                                <tr>
                                                    <th width="2%">الرقم</th>
                                                    <th width="28%">اسم العميل</th>
                                                    <th width="10%">جهة القدوم</th>
                                                    <th width="10%">المهنة</th>
                                                    <th width="8%">رقم التأشيرة</th>
                                                    <th width="8%">رقم الهوية</th>
                                                    <th width="8%">نوع الطلب</th>
                                                    <th width="10%">رقم الطلب</th>
                                                    <th width="12%">وكيل الاستقدام</th>
                                                    <th>البطاقة</th>
                                                    <th>العمليات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($services as $service): ?>

                                                    <tr>
                                                        <td><?php echo $i; $i++; ?></td>
                                                        <td><?php echo $service->customer_name_in_arabic; ?></td>
                                                        <td><?php echo $service->city; ?></td>
                                                        <td><?php echo $service->job_name_arabic; ?></td>
                                                        <td><?php echo $service->visa_number; ?></td>
                                                        <td><?php echo $service->customer_id; ?></td>
                                                        <td><?php echo $service->order_name_arabic; ?></td>
                                                        <td><?php echo $service->order_number; ?></td>
                                                        <td><?php echo $service->representative_name; ?></td>
                                                        <td><?php echo $service->credit_card; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                                                                </button>
                                                                <ul class="datatable-dropdown dropdown-menu icons-left" role="menu">
                                                                    <li><a href="<?php echo site_url('services_entry/print_contract/' . $service->contract_number); ?>/header" class="tips " title=""  target="_blank">
                                                                            <i class="glyphicon glyphicon-print"></i>  <?= lang('customer_with_logo') ?> </a> </li>
                                                                    <li><a href="<?php echo site_url('services_entry/print_contract/' . $service->contract_number); ?>/header/0" class="tips " title=""  target="_blank">
                                                                            <i class="glyphicon glyphicon-print"></i>  <?= lang('customer_without_date') ?> </a> </li>
                                                                    <li><a href="<?php echo site_url('services_entry/print_contract/' . $service->contract_number); ?>" class="" target="_blank">
                                                                            <i class="glyphicon glyphicon-print"></i> <?= lang('customer_without_logo') ?></a></li>
                                                                    <li><a href="<?= site_url('services_entry/print_contract_2/' . $service->contract_number); ?>/header" target="_blank"><i class="glyphicon glyphicon-print"></i> <?= lang('worker_with_logo') ?></a></li>
                                                                    <li><a href="<?= site_url('services_entry/print_contract_2/' . $service->contract_number); ?>" target="_blank"><i class="glyphicon glyphicon-print"></i> <?= lang('worker_without_logo') ?></a></li>
    <li><a href="<?= site_url('services_entry/update/' . $service->contract_number); ?>"> <i class="glyphicon glyphicon-edit"></i> <?=  lang('edit'); ?></a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php else: ?>
                                            <h2><?= lang('no_service'); ?></h2>
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
