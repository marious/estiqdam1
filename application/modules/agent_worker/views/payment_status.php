<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Payment Report</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Payment</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($workers && count($workers)): ?>
                                        <table id="" class="table table-bordered table-striped services-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Maid Name</th>
                                                <th>Customer Name</th>
                                                <th>Payment Status</th>
                                                <th>Note</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($workers as $worker): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $worker->worker_name_in_english; ?></td>
                                                    <td><?= $worker->customer_name_in_arabic; ?></td>
                                                    <td>
                                                        <?php
                                                        $this->db->where('contract_number', $worker->contract_number);
                                                        $query = $this->db->get('agents_payment');
                                                        if ($query->num_rows()) {
                                                            echo '<span class="label label-success">Paid</span>';
                                                        } else {
                                                            echo '<span class="label label-danger">Not Paid</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?=  $worker->note; ?></td>

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