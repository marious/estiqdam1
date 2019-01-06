<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Worker Documents</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Worker Documents</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table id="worker_documents_table" class="table table-bordered table-striped services-table" style="font-size: 15px;">
                                        <thead>
                                        <tr>
                                            <th width="15%">Customer Name</th>
                                            <th width="15%">Worker Name</th>
                                            <th width="10%">Visa</th>
                                            <th width="10%">ID</th>
                                            <th width="10%">Passport</th>
                                            <th width="10%">Contract</th>
                                            <th width="10%">Delegation</th>
                                            <th width="10%">Stamp</th>
                                            <th width="5%">
                                                <select name="representative" id="agent" class="form-control">
                                                    <option value="">المكتب</option>
                                                    <?php
                                                    foreach ($agents as $agent) {
                                                        echo '<option value="'.$agent->id.'">'.$agent->username.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </th>
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