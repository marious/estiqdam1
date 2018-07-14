<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Auto Contract </h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Auto Contract</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">

                                    <table id="not_arrived_table" class="table table-bordered table-striped services-table">
                                        <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Maid Name</th>
                                            <th>Agent</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($workers): ?>
                                            <?php foreach ($workers as $worker): ?>
                                                <tr>
                                                    <th><?= $worker->customer_name_in_arabic;  ?></th>
                                                    <th><?= $worker->name; ?></th>
                                                    <th><?= $worker->username ?></th>
                                                    <th><a href="<?= ('services_entry/make_auto_contract/' . $worker->worker_id); ?>" class="btn btn-success btn-sm">Make Contract</a></th>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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