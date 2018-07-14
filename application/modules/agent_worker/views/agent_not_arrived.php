<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Not Arrived Workers Report</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Not Arrived</div>
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
                                                <th>Stamping Date</th>
                                                <th>Days After Stamping</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($workers as $worker): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $worker->worker_name_in_english; ?></td>
                                                    <td><?= $worker->passport_number; ?></td>
                                                    <td><?= $worker->stamp_date; ?></td>
                                                    <th>
                                                        <?php
                                                        if (! is_null($worker->stamp_date) && $worker->stamp_date != '') {
                                                            $now = time();
                                                            $not_arrived_date = strtotime($worker->stamp_date);
                                                            $date_diff = $now - $not_arrived_date;
                                                            $num_days = abs(floor($date_diff / (60 * 60 * 24))) . ' days';
                                                            echo $num_days;
                                                        }
                                                        ?>
                                                    </th>

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