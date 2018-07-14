<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('not_stamp_report'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> <?= lang('not_stamp_report'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                        <table id="not_stamp_table" class="table table-bordered table-striped services-table" style="font-size: 15px;">
                                           <thead>
                                               <tr>
                                                   <th><?= lang('contract_number'); ?></th>
                                                   <th><?= lang('contract_date'); ?></th>
                                                   <th><?= lang('customer_name') ?></th>
                                                   <th><?= lang('visa_number'); ?></th>
                                                   <th><?= lang('worker_name'); ?></th>
                                                   <th><?= lang('customer_id') ?></th>
                                                   <th><?= lang('passport_number');  ?></th>
                                                   <th>
                                                       <select name="agent" id="agent">
                                                           <option value="">كل المكاتب</option>
                                                           <?php foreach ($agents as $agent): ?>
                                                               <option value="<?= $agent->id; ?>"><?=$agent->username; ?></option>
                                                           <?php endforeach; ?>
                                                       </select>
                                                   </th>
                                                   <th>
                                                       <select name="country" id="country" style="width: 145px;">
                                                           <option value="">كل الدول</option>
                                                           <?php
                                                           foreach ($countries as $country) {
                                                               echo '<option value="'.$country->id.'">'.$country->country_name_in_arabic.'</option>';
                                                           }
                                                           ?>
                                                       </select>
                                                   </th>
                                                   <th><?= lang('delegation_date'); ?></th>
                                                   <th><?= lang('days_after_delegation_date'); ?></th>
                                                   <th><?= lang('action'); ?></th>
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