<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Advanced Reports</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Operations Reports</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <form action="" class="form-horizontal" method="get">
                                        <div class="col-md-2">
                                            <label for="" class="control-label col-md-6">Search For</label>
                                            <div class="col-md-6">
                                                <select name="search_for" id="" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option value="workers" <?php  if (isset($_GET['search_for']) && $_GET['search_for'] == 'workers') echo 'selected'; ?>>Workers</option>
                                                    <option value="customers" <?php  if (isset($_GET['search_for']) && $_GET['search_for'] == 'customers') echo 'selected'; ?>>Customers</option>
                                                </select>
                                            </div>
                                        </div><!-- ./ col-md-3 -->

                                        <div class="col-md-2">
                                            <label for="" class="control-label col-md-4">Agent</label>
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
                                            <label for="" class="control-label col-md-4">Representative</label>
                                            <div class="col-md-8">
                                                <select name="representative" id="" class="form-control">
                                                    <option value="0" <?php if (isset($_GET['representative']) && $_GET['representative'] == '0') echo 'selected'; ?>>-- Select --</option>
                                                    <option value="1" <?php if (isset($_GET['representative']) && $_GET['representative'] == '1') echo 'selected'; ?>>All</option>
                                                    <?php foreach ($representatives as $representative): ?>
                                                        <option value="<?= $representative->id; ?>" <?php if (isset($_GET['representative']) && $_GET['representative'] == $representative->id) echo 'selected'; ?>><?= $representative->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div><!-- ./ col-md-3 -->


                                        <div class="col-md-3">
                                            <label for="" class="control-label col-md-2">When</label>
                                            <div class="col-md-10">
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
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </div><!-- ./ col-md-3 -->

                                    </form>

                                </div>
                            </div>
                        </div>

                        <?php if ($info && count($info)): ?>
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> Result</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">

                                    <?php if ($search_for == 'workers'): ?>
                                    <table class="table table-bordered services-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Worker Name</th>
                                            <th>Selected From</th>
                                            <th>Agent</th>
                                        </tr>
                                        </thead>
                                        <?php if ($info && count($info)): ?>
                                            <tbody>
                                            <?php foreach ($info as $data): ?>
                                                <tr>
                                                    <td><?= $data->id; ?></td>
                                                    <td><?= $data->first_name . ' ' . $data->sur_name; ?></td>
                                                    <td><?= $data->customer_name_in_arabic; ?></td>
                                                    <td><?= $data->username; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        <?php endif; ?>
                                    </table>
                                    <?php endif; ?>

                                    <?php  if ($search_for == 'customers'): ?>
                                    <table class="table table-bordered services-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Contract Date</th>
                                            <th>Customer Name</th>
                                            <th>Visa Number</th>
                                            <th>Representative</th>
                                            <th>Worker Name</th>
                                            <th>Agent</th>
                                        </tr>
                                        </thead>
                                        <?php if ($info && count($info)): ?>
                                        <?php $i = 1; foreach ($info as $data): ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('d-m-Y', strtotime($data->contract_date)); ?></td>
                                                <td><?= $data->customer_name_in_arabic;  ?></td>
                                                <td><?= $data->visa_number; ?></td>
                                                <td><?= $data->representative_name; ?></td>
                                                <td><?= $data->worker_name_in_english; ?></td>
                                                <td><?= $data->agent_name; ?></td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                        <?php endif; ?>
                                    </table>
                                    <?php endif; ?>

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

