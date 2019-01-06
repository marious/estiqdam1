<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('refuse_workers'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> <?= lang('refuse_workers'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table id="refuse_workers_table" class="table table-bordered table-striped services-table" style="font-size: 15px;">
                                        <thead>
                                        <tr>
                                            <th width="10%"><?= lang('contract_number'); ?></th>
                                            <th><?= lang('contract_date'); ?></th>
                                            <th width="20%"><?= lang('customer_name') ?></th>
                                            <th width="15%"><?= lang('worker_name'); ?></th>
                                            <th width="10%"><?= lang('passport_number');  ?></th>
                                            <th width="10%">
                                                <select name="agent" id="agent">
                                                    <option value="">كل المكاتب</option>
                                                    <?php foreach ($agents as $agent): ?>
                                                        <option value="<?= $agent->id; ?>"><?=$agent->username; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </th>
                                            <th><?= lang('refuse_date'); ?></th>
                                            <th><?= lang('reason'); ?></th>
                                        </tr>
                                        </thead>

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