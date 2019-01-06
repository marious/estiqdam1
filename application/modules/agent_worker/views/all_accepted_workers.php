<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3>All Accepted Workers</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('agent_workers'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <div class="">
                                        <table id="all-workers" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الصورة</th>
                                                <th>الاسم</th>
                                                <th>رقم الجواز</th>
                                                <th>المهنة</th>
                                                <th>الراتب</th>
                                                <th>
                                                    <select name="representative" id="agent" class="form-control">
                                                        <option value="">المكتب</option>
                                                        <?php
                                                        foreach ($agents as $agent) {
                                                            echo '<option value="'.$agent->id.'">'.$agent->username.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </th>
                                                <th>اختيرت من</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div><!-- ./table-responsive -->
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


<div id="refuse-modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="worker-form" action="<?= site_url('agent_worker/save_refuse_worker'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Refuse Date</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group" style="margin-bottom: 40px;">
                        <label for="biometric_date" class="control-label col-md-5"><?= lang('refuse_date'); ?></label>
                        <div class="col-md-7">

                            <?php

                            ?>

                            <input type="text" name="refuse_date"  id="refuse_date" class="combodate form-control"  data-min-year="<?php echo date('Y') - 2; ?>" data-format="DD/MM/YYYY" data-template="D MMM YYYY"
                                   value="" data-max-year="<?php echo date('Y'); ?>" required>

                            <div></div>

                        </div>
                    </div>

                    <br>
                    
                    
                    <div class="form-group">
                        <label for="reason" class="control-label col-md-5"><?= lang('reason'); ?></label>
                        <div class="col-md-7">
                            <textarea name="reason" id="" class="form-control"></textarea>
                        </div>
                    </div>




                    <br><br><br>



                </div>
                <div class="modal-footer">
                    <input type="hidden" name="worker_id" id="worker_id" />
                    <input type="hidden" name="contract_number" id="contract_number">
                    <input type="hidden" name="agent_id" id="agent_id">
                    <input type="hidden" name="passport_number" id="passport_number">
                    <input type="submit" name="action" id="action" class="btn btn-success" value="<?= lang('save'); ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>