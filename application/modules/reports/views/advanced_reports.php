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
                                    <form action="" class="form-horizontal" method="get">
                                        <div class="col-md-3">
                                            <label for="" class="control-label col-md-5"><?= lang('representative'); ?></label>
                                            <div class="col-md-7">
                                                <select name="representative" id="" class="form-control">
                                                    <option value="all" <?php if (isset($_GET['representative']) && $_GET['representative'] == 'all') echo 'selected'; ?>>All</option>
                                                    <?php foreach ($representatives as $representative): ?>
                                                        <option value="<?= $representative->id; ?>" <?php if (isset($_GET['representative']) && $_GET['representative'] == $representative->id) echo 'selected'; ?>><?= $representative->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div><!-- ./ col-md-3 -->


                                        <div class="col-md-4">
                                            <label for="" class="control-label col-md-2"><?= lang('when'); ?></label>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class='input-group date' id='dateyearpicker'>
                                                        <input type='text' class="form-control" name="daterange" value="<?php if (isset($_GET['daterange']) && $_GET['daterange'] != '') { echo $_GET['daterange']; } ?>" autocomplete="off">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar">
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- ./ col-md-3 -->


                                        <div class="col-md-2">
                                            <button class="btn btn-primary" type="submit"><?= lang('search') ?></button>
                                        </div><!-- ./ col-md-3 -->

                                    </form>

                                </div>
                            </div>
                        </div>

                            <div class="panel panel-default m-t">
                                <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('result'); ?></div>
                                <div class="panel-body">
                                    <div class="tab-content m-t">

                                        <?php if (isset($info->recruitment_count)): ?>
                                        <div class="col-lg-3 col-xs-6">
                                            <!-- small box -->
                                            <div class="small-box bg-aqua">
                                                <div class="inner">
                                                    <h3><?= $info->recruitment_count ?></h3>

                                                    <p>طلب استقدام</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion-android-clipboard"></i>
                                                </div>
                                                <div class="small-box-footer">
                                                    <h4>المدفوع: <?= $info->finance_prepaid_money ?></h4>
                                                    <hr>
                                                    <h4>المتبقى: <?= $info->finance_remains_money; ?></h4>
                                                    <hr>
                                                    <h4>الاجمالى: <?= $info->finance_recruitment_cost; ?></h4>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if ($details && count($details)): ?>
                                            <?php //var_dump($details); ?>
                                        <?php foreach ($details as $data): ?>
                                                <div class="col-lg-3 col-xs-6" style="margin-bottom: 50px;">
                                                    <!-- small box -->
                                                    <div class="small-box bg-aqua">
                                                        <div class="inner">
                                                            <h3><?= $data->count_recruitment; ?></h3>

                                                            <p> طلب استقدام من <?= $data->nationality_in_arabic; ?></p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion-android-clipboard"></i>
                                                        </div>
                                                        <div class="small-box-footer">
                                                            <h4>المدفوع: <?= $data->finance_prepaid_money ?></h4>
                                                            <hr>
                                                            <h4>المتبقى: <?= $data->finance_remains_money; ?></h4>
                                                            <hr>
                                                            <h4>الاجمالى: <?= $data->finance_recruitment_cost; ?></h4>
                                                            <?php
                                                            $representative = '';
                                                            if (isset($_GET['representative'])) { $representative = '&representative=' . $_GET['representative']; }
                                                            ?>
                                                            <div class="details"><a target="_blank" href="<?= site_url('reports/details_advanced_reports?when=' . $_GET['daterange'] . '&nationality_id=' . $data->worker_nationality_id) . $representative; ?>">التفاصيل</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>

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

