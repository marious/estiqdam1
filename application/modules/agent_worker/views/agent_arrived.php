<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Arrived Workers Report</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Arrived</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($workers && count($workers)): ?>
                                        <table id="" class="table table-bordered table-striped services-table">
                                            <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Worker Name</th>
                                                <th>Passport Number</th>
                                                <th>Customer Name</th>
                                                <th>Customer ID</th>
                                                <th>Visa Number</th>
                                                <th>Arrived At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($workers as $worker): ?>
                                                <tr>
                                                    <td style="width: 4%;"><?= $i; ?></td>
                                                    <td><?= $worker->worker_name_in_english; ?></td>
                                                    <td><?= $worker->passport_number; ?></td>
                                                    <td><?= $worker->customer_name_in_english; ?></td>
                                                    <td><?= $worker->customer_id; ?></td>
                                                    <td><?= $worker->visa_number; ?></td>
                                                    <td><?= date('j-m-Y', strtotime($worker->arrived_date)); ?></td>

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