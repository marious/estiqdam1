<div class="tab-pane" id="3">
    <div class="block-content">
        <div class="panel panel-default m-t">
            <div class="panel-heading panel-heading-special"><?= lang('worker_information'); ?></div>
            <div class="panel-body">
                <div class="tab-content">

                    <div class="form-horizontal entry-form">


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group entry-style">
                                    <label for="worker_name_in_arabic" class="control-label col-md-4">
                                        <?= lang('worker_name_in_arabic'); ?>
                                    </label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'worker_name_in_arabic',
                                            'class'         => 'form-control',
                                            'id'            => 'worker_name_in_arabic',
                                            'value'         => set_value('worker_name_in_arabic'),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('worker_name_in_arabic'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <div class="col-md-6">
                                <div class="form-group entry-style">
                                    <label for="worker_name_in_english" class="control-label col-md-4"><?= lang('worker_name_in_english'); ?></label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'worker_name_in_english',
                                            'class'         => 'form-control',
                                            'id'            => 'worker_name_in_english',
                                            'value'         => set_value('worker_name_in_english', $worker_customer->name),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('worker_name_in_english'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->


                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="agent" class="control-label col-md-4">
                                        <?= lang('agent'); ?>
                                    </label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'class'         => 'form-control',
                                            'id'            => 'agent',
                                        ];
                                        ?>
                                        <?= form_dropdown('agent', $agents,
                                            $worker_customer->agent_id, $data); ?>
                                        <?php echo form_error('agent'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <!-- departure airport -->
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="departure_airport" class="control-label col-md-4"><?= lang('departure_airport'); ?></label>
                                    <div class="col-md-8">
                                        <?= form_dropdown('departure_airport', $departure_airports, $worker_customer->departure_airport, $data); ?>
                                        <?php echo form_error('departure_airport'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <!-- qualification -->
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="qualification" class="control-label col-md-4"><?= lang('qualification'); ?></label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'qualification',
                                            'class'         => 'form-control',
                                            'id'            => 'qualification',
                                            'value'         => set_value('qualification'),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('qualification', $worker_customer->qualification); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <!-- worker salary -->
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="worker_salary" class="control-label col-md-4"><?= lang('worker_salary'); ?></label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'worker_salary',
                                            'class'         => 'form-control',
                                            'id'            => 'worker_salary',
                                            'placeholder'   => 'Worker Salary',
                                            'value'         => set_value('worker_salary', $worker_customer->salary),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('worker_salary'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->


                        </div><!-- ./ row -->

                        <div class="row">

                            <!-- worker nationality -->
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="worker_nationality" class="control-label col-md-5">
                                        <?= lang('worker_nationality'); ?>
                                    </label>
                                    <div class="col-md-7">
                                        <?php
                                        $data = [
                                            'name'          => 'worker_nationality',
                                            'class'         => 'form-control',
                                            'id'            => 'worker_nationality',
                                            'placeholder'   => 'Worker Nationality',
                                        ];
                                        ?>
                                        <?= form_dropdown('worker_nationality', $worker_nationalities, $worker_customer->nationality_id, $data); ?>
                                        <?php echo form_error('worker_nationality'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <!-- visa issued city -->
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="visa_issued_city" class="control-label col-md-5"><?= lang('visa_issued_city'); ?></label>
                                    <div class="col-md-7">
                                        <?php
                                        $data = [
                                            'name'          => 'visa_issued_city',
                                            'class'         => 'form-control',
                                            'id'            => 'visa_issued_city',

                                        ];
                                        ?>
                                        <?= form_dropdown('visa_issued_city',$visa_issued_cities, set_value('visa_issued_city'), $data); ?>
                                        <?php echo form_error('visa_issued_city'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <!-- worker job -->
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="worker_job" class="control-label col-md-4"><?= lang('worker_job'); ?></label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'worker_job',
                                            'class'         => 'form-control',
                                            'id'            => 'worker_job',
                                        ];
                                        ?>
                                        <?= form_dropdown('worker_job', $worker_jobs, $worker_customer->job_id, $data); ?>
                                        <?php echo form_error('worker_job'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->


                            <!-- passport number -->
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="passport_number" class="control-label col-md-4"><?= lang('passport_number'); ?></label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'passport_number',
                                            'class'         => 'form-control',
                                            'id'            => 'passport_number',
                                            'value'         => set_value('passport_number', $worker_customer->passport_number)
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('passport_number'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->


                        </div><!-- ./ row -->
                    </div>



                    <div class="box-footer">
                        <div class="col-md-6 col-md-push-3">
                            <button type="submit" class="btn btn-primary btn-block"><?= lang('save'); ?></button>
                        </div>
                    </div>


                </div>

            </div>
        </div><!-- ./default-panel -->
    </div><!-- ./block-content -->
</div>