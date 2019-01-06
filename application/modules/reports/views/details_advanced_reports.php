<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Advanced Reports</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Advanced Reports</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table class="table services-table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="2%">#</th>
                                            <th>رقم العقد</th>
                                            <th>تاريخ العقد</th>
                                            <th>اسم العميل</th>
                                            <th>هاتف العميل</th>
                                            <th>الوكيل</th>
                                            <th>بلد الاستقدام</th>
                                            <th>المكتب الاجنبى</th>
                                            <th>المدفوع</th>
                                            <th>المتبقى</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($info as $data): ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data->contract_number; ?></td>
                                            <td><?= date('d-m-Y', strtotime($data->contract_date)); ?></td>
                                            <td><?= $data->customer_name_in_arabic; ?></td>
                                            <td><?= $data->customer_mobile; ?></td>
                                            <td><?= $data->name; ?></td>
                                            <td><?= $data->nationality_in_arabic; ?></td>
                                            <td><?= $data->username; ?></td>
                                            <td><?= $data->prepaid_money; ?></td>
                                            <td><?= $data->remains_money; ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                        </tbody>
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

