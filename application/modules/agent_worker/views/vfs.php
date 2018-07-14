<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Selected Workers</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> Selected Workers</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <div class="pull-right">
                                        <a href="" class="btn btn-default" id="not-vfs-worker">Print Not VFS Worker</a>
                                        <a href="" class="btn btn-primary" id="vfs-worker">Print VFS Worker</a>
                                    </div>
                                    <br><br><br>
                                    <div class="clearfix"></div>
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table id="all_accepted" class="table table-bordered table-striped services-table accepted-table-2">
                                        <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>Name Of Worker</th>
                                            <th>Name Of Customer</th>
                                            <th>Customer ID</th>
                                            <th>Visa Number</th>
                                            <th>
                                                <select name="agent" id="agent">
                                                    <option value="0">كل المكاتب</option>
                                                    <?php foreach ($agents as $agent): ?>
                                                        <option value="<?= $agent->id; ?>"><?=$agent->username; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </th>
                                            <th>Contract Received</th>
                                            <th>Biometric Date</th>
                                            <th>MEMO</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
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

<div id="worker-modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="worker-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Worker Data</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group" style="margin-bottom: 40px;">
                        <label for="biometric_date" class="control-label col-md-5">BIO METRIC DATE</label>
                        <div class="col-md-7 col-md-push-1">

                            <?php

                            ?>

                            <input type="text" name="biometric_date"  id="biometric_date" class="combodate form-control"  data-min-year="<?php echo date('Y') - 1; ?>" data-format="DD/MM/YYYY" data-template="D MMM YYYY"
                                   value="<?php echo set_value('biometric_date'); ?>" data-max-year="<?php echo date('Y'); ?>">

                            <div><?php echo form_error('biometric_date') ?></div>

                        </div>
                    </div>



                    <div class="form-group" style="margin-top: 60px;">
                        <label for="contract_received_date" class="control-label col-md-5"><?php echo 'Contract Received Date'; ?></label>
                        <div class="col-md-7 col-md-push-1">

                            <?php

                            ?>

                            <input type="text" name="contract_received_date" id="contract-received-date" class="combodate form-control"  data-min-year="<?php echo date('Y') - 1; ?>" data-format="DD/MM/YYYY" data-template="D MMM YYYY"
                                   value="<?php echo set_value('contract_received_date'); ?>" data-max-year="<?php echo date('Y'); ?>">

                            <div><?php echo form_error('contract_received_date') ?></div>

                        </div>
                    </div>

                    <br>



                </div>
                <div class="modal-footer">
                    <input type="hidden" name="worker_id" id="worker_id" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Update" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>