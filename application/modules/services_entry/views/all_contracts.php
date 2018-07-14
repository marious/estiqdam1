<section>
    <div class="container-fluid" style="width: 2000px">
        <div class="row">
            <div class="content">
                <div class="page-header">

                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="<?= site_url('services_entry/all_contracts'); ?>"><?= lang('all_contracts'); ?></a>
                            </li>



                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('services'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <div class="table-responsive">
                                        <table id="all-contracts" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>اسم العميل</th>
                                                    <th>اسم العامل</th>
                                                    <th>رقم التأشيرة</th>
                                                    <th>رقم الهوية</th>
                                                    <th>جوال العميل</th>
                                                    <th>المسوق</th>
                                                    <th>
                                                        <select name="representative" id="representative" class="form-control" style="width: 145px;">
                                                            <option value="">كل المندوبين</option>
                                                            <?php
                                                            foreach ($representatives as $representative) {
                                                                echo '<option value="'.$representative->id.'">'.$representative->name.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="agent" id="agent" class="form-control">
                                                            <option value="">كل المكاتب</option>
                                                            <?php foreach ($agents as $agent): ?>
                                                                <option value="<?= $agent->id; ?>"><?=$agent->username; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </th>
                                                    <th>المبلغ المدفوع</th>
                                                    <th>المبلغ المتبقى</th>
                                                    <th>مطار الوصول</th>
                                                    <th>تاريخ التفويض</th>
                                                    <th>تاريخ التفييز</th>
                                                    <th>تاريخ الوصول</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div><!-- ./table-responsive -->

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
