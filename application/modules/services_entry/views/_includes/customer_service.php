<div class="tab-pane" id="2">
    <div class="block-content">
        <div class="panel panel-default m-t">
            <div class="panel-heading panel-heading-special"><?= lang('customer_information'); ?></div>
            <div class="panel-body">
                <div class="tab-content">

                    <div class="form-horizontal entry-form">


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group entry-style">
                                    <label for="customer_name_in_arabic" class="control-label col-md-4">
                                        <?= lang('customer_name_in_arabic') ?>
                                    </label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'customer_name_in_arabic',
                                            'class'         => 'form-control',
                                            'id'            => 'customer_name_in_arabic',
                                            'value'         => set_value('customer_name_in_arabic'),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('customer_name_in_arabic'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <div class="col-md-6">
                                <div class="form-group entry-style">
                                    <label for="customer_name_in_english" class="control-label col-md-4"><?= lang('customer_name_in_english') ?></label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'customer_name_in_english',
                                            'class'         => 'form-control',
                                            'id'            => 'customer_name_in_english',
                                            'value'         => set_value('customer_name_in_english'),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('customer_name_in_english'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->



                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="customer_id" class="control-label col-md-5">
                                        <?= lang('customer_id') ?>
                                    </label>
                                    <div class="col-md-7">
                                        <?php
                                        $data = [
                                            'name'          => 'customer_id',
                                            'class'         => 'form-control',
                                            'id'            => 'customer_id',
                                            'value'         => set_value('customer_id')
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('customer_id'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <div class="col-md-3">
                                <div class="form-group entry-style">
                                    <label for="customer_nationality" class="control-label col-md-6">
                                        <?= lang('customer_nationality'); ?>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                        $data = [
                                            'name'          => 'customer_nationality',
                                            'class'         => 'form-control',
                                            'id'            => 'customer_nationality',
                                        ];
                                        ?>
                                        <?= form_dropdown('customer_nationality', $customer_nationalities, set_value('customer_nationality'), $data); ?>
                                        <?php echo form_error('customer_nationality'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->


                            <div class="col-md-4">
                                <div class="form-group entry-style">
                                    <label for="customer_mobile" class="control-label col-md-6">
                                        <?= lang('customer_mobile'); ?>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                        $data = [
                                            'name'          => 'customer_mobile',
                                            'class'         => 'form-control',
                                            'id'            => 'customer_mobile',
                                            'value'         => set_value('customer_mobile'),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('customer_mobile'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                        </div><!-- ./ row -->


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group entry-style">
                                    <label for="visa_number" class="control-label col-md-3">
                                        <?= lang('visa_number'); ?>
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = [
                                            'name'          => 'visa_number',
                                            'class'         => 'form-control',
                                            'id'            => 'visa_number',
                                            'value'         => set_value('visa_number'),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('visa_number'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                            <div class="col-md-6">
                                <div class="form-group entry-style">
                                    <label for="visa_date" class="control-label col-md-4">
                                        <?= lang('visa_date'); ?>
                                    </label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = [
                                            'name'          => 'visa_date',
                                            'class'         => 'form-control',
                                            'id'            => 'visa_date',
                                            'value'         => set_value('visa_date'),
                                        ];
                                        ?>
                                        <?= form_input($data); ?>
                                        <?php echo form_error('visa_date'); ?>
                                    </div>
                                </div><!-- ./ form-group -->
                            </div><!-- ./col-md-3 -->

                        </div>


                        <div class="row">




                        </div>


                    </div>
                </div>
            </div>
        </div><!-- ./default-panel -->
    </div><!-- ./block-content -->
</div>