<div class="block-content">
    <div class="panel panel-default m-t">
        <div class="panel-heading panel-heading-special"> <?= lang('service_contract'); ?></div>
        <div class="panel-body">
            <div class="tab-content">

                <div class="form-horizontal entry-form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="contract_number" class="control-label col-md-6"><?= lang('contract_number'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'contract_number',
                                        'class'         => 'form-control',
                                        'id'            => 'contract_number',
                                        'value'         => set_value('contract_number', $contract->contract_number)
                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('contract_number'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->

                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="contract_date" class="control-label col-md-6"><?= lang('contract_date'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $current_date = date('d-m-Y', strtotime($contract->contract_date));
                                    $data = [
                                        'name'          => 'contract_date',
                                        'class'         => 'form-control datepicker',
                                        'id'            => 'contract_date',
                                        'value'         => set_value('contract_date', $current_date),

                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('contract_date'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->

                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="contract_period" class="control-label col-md-6"><?= lang('contract_period'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'contract_period',
                                        'class'         => 'form-control',
                                        'id'            => 'contract_period',
                                        'value'         => '24 Month',

                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('contract_period'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->

                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="vacation_period" class="control-label col-md-6"><?= lang('vacation_period'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'vacation_period',
                                        'class'         => 'form-control',
                                        'id'            => 'vacation_period',
                                        'value'         => set_value('vacation_period', $services_contract->vacation_period),
                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('vacation_period'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->

                    </div>



                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="recruitment_cost" class="control-label col-md-6"><?= lang('recruitment_cost'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'recruitment_cost',
                                        'class'         => 'form-control',
                                        'id'            => 'recruitment_cost',
                                        'value'         => set_value('recruitment_cost', $service_finance->recruitment_cost),
                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('recruitment_cost'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->

                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="prepaid_money" class="control-label col-md-6"><?= lang('prepaid_money'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'prepaid_money',
                                        'class'         => 'form-control',
                                        'id'            => 'prepaid_money',
                                        'value'         => set_value('prepaid_money', $service_finance->prepaid_money),
                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('prepaid_money'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->


                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="credit_card" class="control-label col-md-6"><?= lang('credit_card'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'credit_card_id',
                                        'class'         => 'form-control',
                                        'id'            => 'credit_card',
                                    ];
                                    ?>
                                    <?php
                                    echo form_dropdown('credit_card_id', $credit_cards, set_value('credit_card_id', $credit_card_id), $data);
                                    ?>
                                    <?php echo form_error('credit_card'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->

                        <!-- ./representative -->
                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="representative_id" class="control-label col-md-4">
                                    <?= lang('representative'); ?>
                                </label>
                                <div class="col-md-8">
                                    <?php
                                    $data = [
                                        'class'         => 'form-control',
                                        'id'            => 'representative',
                                    ];
                                    ?>
                                    <?= form_dropdown('representative_id', $representatives,
                                        set_value('representative', $representative->id), $data); ?>
                                    <?php echo form_error('representative'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->



                    </div><!-- ./ row -->


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="order_number" class="control-label col-md-6"><?= lang('order_number'); ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'order_number',
                                        'class'         => 'form-control',
                                        'id'            => 'order_number',
                                        'value'         => set_value('order_number', $order_number),
                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('order_number'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-6 -->

                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="order_type" class="control-label col-md-6">
                                    <?= lang('order_type'); ?>
                                </label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'order_type',
                                        'class'         => 'form-control',
                                        'id'            => 'order_type',
                                    ];
                                    ?>
                                    <?php
                                    echo form_dropdown('order_type', $order_types, set_value('order_type', $order_type_id), $data);
                                    ?>
                                    <?php echo form_error('order_type'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-6 -->

                        <!-- Marketer -->
                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="marketer" class="control-label col-md-6"><?= lang('marketer') ?></label>
                                <div class="col-md-6">
                                    <?php
                                    $data = [
                                        'name'          => 'marketer',
                                        'class'         => 'form-control',
                                        'id'            => 'marketer',
                                        'value'         => set_value('marketer', $services_contract->marketer),
                                    ];
                                    ?>
                                    <?= form_input($data); ?>
                                    <?php echo form_error('marketer'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-5 -->

                        <!-- arrival airport -->
                        <div class="col-md-3">
                            <div class="form-group entry-style">
                                <label for="arrival_airport" class="control-label col-md-4"><?= lang('arrival_airport'); ?></label>
                                <div class="col-md-8">
                                    <?= form_dropdown('arrival_airport', $arrival_airports, set_value('arrival_airport', $arrival_airport->id), $data); ?>
                                    <?php echo form_error('arrival_airport'); ?>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->



                    </div><!-- ./ row -->



                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group entry-style">
                                <label for="notes_1" class="control-label col-md-2"><?= lang('notes_1'); ?></label>
                                <div class="col-md-10">
                                    <textarea name="notes_1" id="notes_1" class="form-control"><?= $notes1; ?></textarea>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->

                        <div class="col-md-6">
                            <div class="form-group entry-style">
                                <label for="notes_2" class="control-label col-md-2"><?= lang('notes_2') ?></label>
                                <div class="col-md-10">
                                    <textarea name="notes_2" id="notes_2" class="form-control"><?= $notes2; ?></textarea>
                                </div>
                            </div><!-- ./ form-group -->
                        </div><!-- ./col-md-3 -->
                    </div><!-- ./ row -->

                </div>
            </div>
        </div><!-- ./default-panel -->
    </div><!-- ./block-content -->
</div>
