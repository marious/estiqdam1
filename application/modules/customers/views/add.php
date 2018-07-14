<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Customers / Add  New Customer</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t services-entry-form">

                    <form method="post" action="">

                        <div class="tab-pane" id="2">
                            <div class="block-content">
                                <div class="panel panel-default m-t">
                                    <div class="panel-heading panel-heading-special"><?= lang('customer_information'); ?></div>
                                    <div class="panel-body">
                                        <div class="tab-content">

                                            <div class="form-horizontal entry-form">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group entry-style">
                                                            <label for="username" class="control-label col-md-4"><?= lang('username'); ?></label>
                                                            <div class="col-md-8">
                                                                <?php
                                                                $data = [
                                                                    'name' => 'username',
                                                                    'class' => 'form-control',
                                                                    'id' => 'username',
                                                                    'value' => set_value('username', $staff->username)
                                                                ];
                                                                echo form_input($data);
                                                                echo form_error('username');
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div><!-- col-md-4 -->

                                                    <div class="col-md-4">
                                                        <div class="form-group entry-style">
                                                            <label for="password" class="control-label col-md-4">
                                                                <?= lang('password'); ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="password" name="password" class="form-control">
                                                                <?= form_error('password'); ?>
                                                            </div>
                                                        </div>
                                                    </div><!-- ./col-md-4 -->

                                                    <div class="col-md-4">
                                                        <div class="form-group entry-style">
                                                            <label for="password_confirm" class="control-label col-md-4">
                                                                <?= lang('confirm_password'); ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="password" name="password_confirm" class="form-control">
                                                                <?= form_error('password_confirm'); ?>
                                                            </div>
                                                        </div>
                                                    </div><!-- ./col-md-4 -->


                                                </div><!-- ./ row -->


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
                                                                    'value'         => set_value('customer_name_in_arabic', $customer->customer_name_in_arabic),
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
                                                                    'value'         => set_value('customer_name_in_english', $customer->customer_name_in_english),
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
                                                                    'value'         => set_value('customer_id', $customer->customer_id)
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

                                                                    'class'   => 'form-control',
                                                                    'id'      => 'customer_nationality',
                                                                ];
                                                                ?>
                                                                <?= form_dropdown('nationality_id', $nationalities, $staff->nationality_id, $data); ?>
                                                                <?php echo form_error('nationality_id'); ?>
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
                                                                    'value'         => set_value('customer_mobile', $customer->customer_mobile),
                                                                ];
                                                                echo form_input($data);
                                                                echo form_error('customer_mobile');
                                                                ?>
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
                                                                    'value'         => set_value('visa_number', $customer->visa_number),
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
                                                                    'value'         => set_value('visa_date', $customer->visa_date),
                                                                ];
                                                                ?>
                                                                <?= form_input($data); ?>
                                                                <?php echo form_error('visa_date'); ?>
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-3 -->

                                                </div>


                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="visa_date" class="control-label col-md-3">
                                                                <?= lang('id_image') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="file" id="id_image" name="id_image" class="form-control">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->

                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="visa_image" class="control-label col-md-4">
                                                                <?= lang('visa_image') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="file" id="visa_image" name="visa_image" class="form-control">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->

                                                </div><!-- ./row -->

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="customer_address" class="control-label col-md-3">
                                                                <?= lang('customer_address') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="customer_address" name="customer_address" class="form-control" value="<?= set_value('customer_address', $customer->customer_address); ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->

                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="street" class="control-label col-md-3">
                                                                <?= lang('street') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="street" name="street" class="form-control" value="<?= set_value('street', $customer->street); ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->
                                                </div><!-- ./row -->


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="area" class="control-label col-md-3">
                                                                <?= lang('area') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="area" name="area" class="form-control" value="<?= set_value('area', $customer->area); ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->

                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="city" class="control-label col-md-3">
                                                                <?= lang('city') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="city" name="city" class="form-control" value="<?= set_value('city', $customer->city) ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->
                                                </div><!-- ./row -->


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="english_customer_address" class="control-label col-md-3">
                                                                <?= lang('english_customer_address') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="english_customer_address" name="english_customer_address" class="form-control" value="<?= set_value('english_customer_address', $customer->english_customer_address); ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="english_area" class="control-label col-md-3">
                                                                <?= lang('english_area') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="english_area" name="english_area" class="form-control" value="<?= set_value('english_area', $customer->english_area); ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->

                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="english_city" class="control-label col-md-3">
                                                                <?= lang('english_city') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="english_city" name="english_city" class="form-control" value="<?= set_value('english_city', $customer->english_city) ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->
                                                </div><!-- ./row -->

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="civil_status" class="control-label col-md-3">
                                                                <?= lang('civil_status') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <?php
                                                                $selected_martial_status = isset($_POST['civil_status']) ? $_POST['civil_status'] : $customer->civil_status;
                                                                $options = [
                                                                    '' => '-- SELECT --',
                                                                    '1' => 'SINGLE',
                                                                    '2' => 'MARRIED',
                                                                ];
                                                                echo form_dropdown('civil_status', $options, $selected_martial_status, 'class="form-control"');
                                                                echo form_error('civil_status');
                                                                ?>
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->

                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="family_members" class="control-label col-md-3">
                                                                <?= lang('family_members') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="family_members" name="family_members" class="form-control" value="<?= set_value('family_members', $customer->family_members ); ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->
                                                </div><!-- ./row -->

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group entry-style">
                                                            <label for="phone_number" class="control-label col-md-3">
                                                                <?= lang('phone_number') ?>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?= set_value('phone_number', $customer->phone_number); ?>">
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    </div><!-- ./col-md-6 -->
                                                </div><!-- ./row -->


                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div><!-- ./default-panel -->
                        </div><!-- ./block-content -->
                </div>


                <div class="col-md-6 col-md-push-3">
                    <button class="btn btn-block btn-primary"><?= lang('save'); ?></button>
                </div>

                </form>

            </div>
            <!-- ./page-header -->
        </div>
    </div>
    </div>
</section>