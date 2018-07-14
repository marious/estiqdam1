<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Not Piad Customers</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Not Paid Customers</div>
                            <div class="panel-body">

                                <div class="col-md-4">
                                    <label for="" class="control-label col-md-2"><?= lang('when'); ?></label>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <div class='input-group date' id='dateyearpicker'>
                                                <input type='text' id="contract_date" class="form-control" name="daterange" value="<?php if (isset($_GET['daterange']) && $_GET['daterange'] != '') { echo $_GET['daterange']; } ?>">
                                                <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar">
                                                            </span>
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- ./ col-md-3 -->
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="search_btn"><?= lang('search') ?></button>
                                </div><!-- ./ col-md-3 -->

<div class="clearfix"></div>


                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                        <table id="finance_table" class="table table-bordered table-striped services-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?= lang('contract_date'); ?></th>
                                                <th><?= lang('customer_name'); ?></th>
                                                <th><?= lang('customer_mobile'); ?></th>
                                                <th>
                                                    <select name="representative" id="country" style="width: 145px;">
                                                        <option value="">كل الدول</option>
                                                        <?php
                                                        foreach ($countries as $country) {
                                                            echo '<option value="'.$country->id.'">'.$country->country_name_in_arabic.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </th>
                                                <th><?= lang('recruitment_cost'); ?></th>
                                                <th><?= lang('prepaid_money'); ?></th>
                                                <th><?= lang('amount_of_remains'); ?></th>
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