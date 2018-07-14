<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('financial_report'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> </div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <form action="" class="form-horizontal" method="get">
                                        <div class="col-md-3">
                                            <label for="" class="control-label col-md-4"><?= lang('agent'); ?></label>
                                            <div class="col-md-8">
                                                <select name="agent" id="" class="form-control">
                                                    <option value="0" <?php if (isset($_GET['agent']) &&  $_GET['agent'] == '0') echo 'selected';?>>-- Select --</option>
                                                    <option value="1"  <?php if (isset($_GET['agent']) &&  $_GET['agent'] == '1') echo 'selected';?>>All</option>
                                                    <?php foreach ($agents as $agent): ?>
                                                        <option value="<?= $agent->id; ?>" <?php if (isset($_GET['agent']) && $_GET['agent'] == $agent->id) echo 'selected'; ?>><?= $agent->username; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div><!-- ./ col-md-3 -->

                                        <div class="col-md-3">
                                            <label for="" class="control-label col-md-5"><?= lang('representative'); ?></label>
                                            <div class="col-md-7">
                                                <select name="representative" id="" class="form-control">
                                                    <option value="0" <?php if (isset($_GET['representative']) && $_GET['representative'] == '0') echo 'selected'; ?>>-- Select --</option>
                                                    <option value="1" <?php if (isset($_GET['representative']) && $_GET['representative'] == '1') echo 'selected'; ?>>All</option>
                                                    <?php foreach ($representatives as $representative): ?>
                                                        <option value="<?= $representative->id; ?>" <?php if (isset($_GET['representative']) && $_GET['representative'] == $representative->id) echo 'selected'; ?>><?= $representative->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div><!-- ./ col-md-3 -->


                                        <div class="col-md-4">
                                            <label for="" class="control-label col-md-3"><?= lang('when'); ?></label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <div class='input-group date' id='dateyearpicker'>
                                                        <input type='text' class="form-control" name="daterange" value="<?php if (isset($_GET['daterange']) && $_GET['daterange'] != '') { echo $_GET['daterange']; } ?>">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar">
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- ./ col-md-3 -->


                                        <div class="col-md-2">
                                            <button class="btn btn-primary" type="submit"><?= lang('search'); ?></button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        <?php if ($info && count($info)): ?>
                            <div class="panel panel-default m-t">
                                <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('result'); ?></div>
                                <div class="pull-right"><a target="_blank" href="<?= site_url('reports/print_financial_reports?agent=' . $_GET['agent'] . '&representative=' . $_GET['representative'] . '&daterange=' . $_GET['daterange']); ?>" class="btn btn-success"><?= lang('print_report'); ?></a></div>
                                <br>
                                <div class="panel-body">
                                    <div class="tab-content m-t">
                                            <table class="table table-bordered services-table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?= lang('contract_date'); ?></th>
                                                    <th><?= lang('customer_name'); ?></th>
                                                    <th><?= lang('customer_mobile'); ?></th>
                                                    <th><?= lang('representative'); ?></th>
                                                    <th><?= lang('recruitment_cost'); ?></th>
                                                    <th><?= lang('prepaid_money'); ?></th>
                                                    <th><?= lang('remains_money'); ?></th>
                                                </tr>
                                                </thead>
                                                <?php if ($info && count($info)): ?>
                                                <?php
                                                        $totalPrepaid = 0;
                                                        $total_remains = 0;
                                                ?>
                                                    <?php foreach ($info as $data): ?>
                                                    <?php
                                                        $totalPrepaid += $data->prepaid_money;
                                                        $total_remains += $data->remains_money;
                                                        ?>
                                                        <tr>
                                                            <td><?= $data->contract_number; ?></td>
                                                            <td><?= date('d-m-Y', strtotime($data->contract_date)); ?></td>
                                                            <td><?= $data->customer_name_in_arabic;  ?></td>
                                                            <td><?= $data->customer_mobile;  ?></td>
                                                            <td><?= $data->representative_name; ?></td>
                                                            <td><?= $data->recruitment_cost; ?></td>
                                                            <td><?= $data->prepaid_money; ?></td>
                                                            <td><?= $data->remains_money; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="2"><?= lang('total_prepaid'); ?> </td>
                                                    <td colspan="6"><strong><?= $totalPrepaid; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><?= lang('total_remains'); ?> </td>
                                                    <td colspan="6"><strong><?= $total_remains; ?></strong></td>
                                                </tr>
                                                <?php endif; ?>
                                            </table>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div>
    </div>
</section>

