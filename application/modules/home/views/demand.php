<div class="container">
    <div class="col-md-3 visible-sm visible-lg visible-md">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
    <div class="col-md-9 building-container">
        <h2>قائمة الطلبات</h2>
        <hr>
        <?php if (isset($worker)): ?>
        <div class="profile-content">

            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <h2><?= $this->session->flashdata('success'); ?></h2>
            </div>
            <?php else: ?>
            <div class="alert alert-info">
                <h2>حالة الطلب: </h2>
            </div>
            <?php endif; ?>


            <h3>عاملة منزلية : <?= $worker->name; ?></h3>

            <div class="row">
                <div class="col-md-4">
                    <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" alt="" class="img-responsive">
                    <br>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>اﻻسم</th>
                            <td><?= $worker->name; ?></td>
                        </tr>
                        <tr>
                            <th>السن</th>
                            <td><?= calculate_age($worker->date_of_birth); ?></td>
                        </tr>
                        <tr>
                            <th>تاريخ الميلاد</th>
                            <td><?= $worker->date_of_birth; ?></td>
                        </tr>
                        <tr>
                            <th>الديانة</th>
                            <td><?= $worker->religion; ?></td>
                        </tr>
                        <tr>
                            <th>المهنة</th>
                            <td>عاملة منزلية</td>
                        </tr>
                        <tr>
                            <th>الجنسية</th>
                            <td>نيجريا</td>
                        </tr>
                        <tr>
                            <th>الحالة اﻻجتماعية</th>
                            <td>
                                <?php echo ($worker->marital_status == 1) ? 'أعزب' : 'متزوج'; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>الطول</th>
                            <td><?= $worker->height; ?> cm</td>
                        </tr>
                        <tr>
                            <th>الوزن</th>
                            <td><?= $worker->weight; ?> Kgs</td>
                        </tr>
                        <tr>
                            <th>اللغة الانجليزية</th>
                            <td>
                                <?php if ($worker->english_language == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>اللغة العربية</th>
                            <td>
                                <?php if ($worker->arabic_language == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>التنظيف</th>
                            <td>
                                <?php if ($worker->cleaning == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>الكى</th>
                            <td>
                                <?php if ($worker->ironing == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>الطبخ</th>
                            <td>
                                <?php if ($worker->cooking == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>رعاية اﻻطفال</th>
                            <td>
                                <?php if ($worker->baby_sitting == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>رعاية الكبار</th>
                            <td>
                                <?php if ($worker->old_care == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i><
                                <?php endif; ?>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>
            <?php else: ?>
            <h2>لم يتم اضافة اى طلب</h2>
        <?php endif; ?>
    </div>
    <div class="col-md-3 visible-xs">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
</div>