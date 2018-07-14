<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Not Stamp Workers Report</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Not Stamp</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($workers && count($workers)): ?>
                                        <table id="" class="table table-bordered table-striped services-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Passport Number</th>
                                                <th>Visa Delegation Date</th>
                                                <th>Days After Visa Delegation Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($workers as $worker): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $worker->worker_name_in_english; ?></td>
                                                    <td><?= $worker->passport_number; ?></td>
                                                    <?php
                                                    $delegation_date = $worker->contract_date;
                                                    if (!is_null($worker->delegation_date) || $worker->delegation_date != '') {
                                                        $delegation_date = $worker->delegation_date;
                                                    }
                                                    ?>
                                                    <td>
                                                       <?= $delegation_date; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $now = time();
                                                        $vd_date = strtotime($delegation_date);
                                                        $date_diff = $now - $vd_date;
                                                        $num_days = abs(floor($date_diff / (60 * 60 * 24))) . ' days';
                                                        echo $num_days;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <h2>No Workers Found.</h2>
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