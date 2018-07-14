<form action="<?= site_url('staff/add_user_customer'); ?>" class="form-horizontal" method="post">
    <fieldset>

        <div class="form-group">
            <label for="username-2" class="control-label col-md-3"><?= lang('username'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'          => 'username',
                    'class'         => 'form-control',
                    'id'            => 'username-2',
                    'value'         => set_value('username'),
                ];
                ?>
                <?= form_input($data); ?>
                <?php echo form_error('username'); ?>
            </div>
        </div><!-- ./ form-group -->


        <div class="form-group">
            <label for="password-2" class="control-label col-md-3"><?= lang('password'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'          => 'password',
                    'class'         => 'form-control',
                    'id'            => 'password-2',
                ];
                ?>
                <?= form_password($data); ?>
                <?php echo form_error('password'); ?>
            </div>
        </div><!-- ./ form-group -->


        <div class="form-group">
            <label for="password_confirm_2" class="control-label col-md-3"><?= lang('confirm_password'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'          => 'password_confirm',
                    'class'         => 'form-control',
                    'id'            => 'password_confirm_2',
                ];
                ?>
                <?= form_password($data); ?>
                <?php echo form_error('password_confirm'); ?>
            </div>
        </div><!-- ./ form-group -->

        <!-- customer_name_in_arabic -->
        <div class="form-group">
            <label for="customer_name_in_arabic" class="control-label col-md-3"><?= lang('customer_name_in_arabic'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'  => 'customer_name_in_arabic',
                    'class' => 'form-control',
                    'id'    => 'customer_name_in_arabic',
                ];
                echo form_input($data);
                echo form_error('customer_name_in_arabic');
                ?>
            </div>
        </div>

        <!-- customer_name_in_english -->
        <div class="form-group">
            <label for="customer_name_in_english" class="control-label col-md-3"><?= lang('customer_name_in_english'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'  => 'customer_name_in_english',
                    'class' => 'form-control',
                    'id'    => 'customer_name_in_english',
                ];
                echo form_input($data);
                echo form_error('customer_name_in_english');
                ?>
            </div>
        </div>

        <!-- customer nationality -->
        <div class="form-group">
            <label for="customer_nationality" class="control-label col-md-3"><?= lang('customer_nationality'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'  => 'customer_nationality_id',
                    'class' => 'form-control',
                    'id'    => 'customer_nationality',
                ];
                echo form_dropdown('customer_nationality_id', $customer_nationalities,
                    set_value('customer_nationality'), $data);
                echo form_error('customer_nationality');
                ?>
            </div>
        </div>

        <!-- customer ID -->
        <div class="form-group">
            <label for="customer_id" class="control-label col-md-3"><?= lang('customer_id'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'  => 'customer_id',
                    'class' => 'form-control',
                    'id'    => 'customer_id',
                ];
                echo form_input($data);
                echo form_error('customer_id');
                ?>
            </div>
        </div>

        <!-- visa number -->
        <div class="form-group">
            <label for="visa_number" class="control-label col-md-3"><?= lang('visa_number'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'  => 'visa_number',
                    'class' => 'form-control',
                    'id'    => 'visa_number',
                ];
                echo form_input($data);
                echo form_error('visa_number');
                ?>
            </div>
        </div>

        <!-- visa date -->
        <div class="form-group">
            <label for="visa_data" class="control-label col-md-3"><?= lang('visa_date'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'  => 'visa_date',
                    'class' => 'form-control',
                    'id'    => 'visa_data',
                ];
                echo form_input(    $data);
                echo form_error('visa_date');
                ?>
            </div>
        </div>

        <!--  Customer Mobile   -->
        <div class="form-group">
            <label for="customer_mobile" class="control-label col-md-3"><?= lang('customer_mobile'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'  => 'customer_mobile',
                    'class' => 'form-control',
                    'id'    => 'customer_mobile',
                ];
                echo form_input($data);
                echo form_error('customer_mobile');
                ?>
            </div>
        </div>



        <div class="box-footer">
            <div class="col-md-6 col-md-push-3">
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </div>


    </fieldset>
    <!--                                   </div>-->
</form>