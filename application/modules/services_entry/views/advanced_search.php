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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="searched_by"><?= lang('search_by') ?></label>
                                            <?php
                                            $data = [
                                                'name'  => 'searched_by',
                                                'class' => 'form_control',
                                                'id'    => 'searched_by',
                                            ];
                                            ?>
                                            <select name="searched_by" id="searched_by" class="form-control">
                                                <option value="0">-- <?= lang('select'); ?> --</option>
                                                <?php foreach ($searched_by as $key => $value): ?>
                                                    <option value="<?= $key; ?>" <?php if (isset($_GET['searched_by']) && $_GET['searched_by'] == $key) {echo 'selected';} ?>><?= $value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="advanced-search-entry">
                                        <div class="col-md-4">
                                            <label for="searched_query"><?= lang('enter') ?> <span class="enter-keyword"></span></label>
                                            <input type="text" class="form-control" name="searched_value" id="searched_query" autocomplete="off" value="<?php if (isset($_GET['searched_value']) && !empty($_GET['searched_value']))  { echo $_GET['searched_value']; }?>">
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

                <?php if (isset($view_services) && $view_services == true): ?>

                    <div class="panel panel-default m-t">
                        <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('services'); ?></div>
                        <div class="panel-body">
                            <div class="tab-content m-t">
                                <?php $this->load->view('includes/flash_messages'); ?>
                                <?php if ($services && count($services)): ?>
                                    <table id="services_table" class="table table-bordered table-striped services-table" style="font-size: 15px;">
                                        <thead>
                                        <tr>
                                            <th>الرقم</th>
                                            <th>التاريخ</th>
                                            <th>اسم العميل</th>
                                            <th>جهة القدوم</th>
                                            <th>المهنة</th>
                                            <th>رقم التأشيرة</th>
                                            <th>رقم الهوية</th>
                                            <th>نوع الطلب</th>
                                            <th>رقم الطلب</th>
                                            <th>وكيل الاستقدام</th>
                                            <th>البطاقة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($services as $service): ?>

                                            <tr>
                                                <td><?php echo $service->contract_number; ?></td>
                                                <td><?php echo date('j-m-Y', strtotime($service->contract_date)); ?></td>
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
                                                            <li><a href="<?php echo site_url('services_entry/print_contract/' . $service->contract_number); ?>" class="" target="_blank">
                                                                    <i class="glyphicon glyphicon-print"></i> <?= lang('customer_without_logo') ?></a></li>
                                                            <li><a href="<?= site_url('services_entry/print_contract_2/' . $service->contract_number); ?>/header" target="_blank"><i class="glyphicon glyphicon-print"></i> <?= lang('worker_with_logo') ?></a></li>
                                                            <li><a href="<?= site_url('services_entry/print_contract_2/' . $service->contract_number); ?>" target="_blank"><i class="glyphicon glyphicon-print"></i> <?= lang('worker_without_logo') ?></a></li>
                                                            <li><a href="<?= site_url('services_entry/update/' . $service->contract_number); ?>"> <i class="glyphicon glyphicon-edit"></i> <?=  lang('edit'); ?></a></li>
                                                            <li><a href="<?= site_url('services_entry/cancel_contract/' . $service->contract_number) ?>"><?= lang('cancel_contract'); ?></a></li>
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

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>