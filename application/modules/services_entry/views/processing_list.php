<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
<!--                <div class="page-header">-->
<!--                    <h3 class="page-title">Processing Contracts</h3>-->
<!--                </div>-->
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Processing Contracts</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table id="processing_table" class="table table-bordered table-striped services-table">
                                        <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Visa Number</th>
                                            <th>Maid Name</th>
                                            <th>Passport Number</th>
                                            <th>
                                                <select name="representative" id="representative" class="form-control" style="width: 145px;">
                                                    <option value="">كل المندوبين</option>
                                                    <?php
                                                    foreach ($representatives as $representative) {
                                                        echo '<option value="'.$representative->id.'">'.$representative->name.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </th>
                                            <th>
                                                <select name="agent" id="agent" class="form-control">
                                                    <option value="">كل المكاتب</option>
                                                    <?php foreach ($agents as $agent): ?>
                                                        <option value="<?= $agent->id; ?>"><?=$agent->username; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </th>
                                            <th>Action</th>
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