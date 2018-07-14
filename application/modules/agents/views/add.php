<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Agents / Add  New Agent</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'agents'; ?>"><?= lang('agents'); ?></a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <?= lang('agents'); ?></div>
                            <div class="panel-body">
                                <div class="m-t">
                                    <div class="tab-content users-form">
                                        <?php echo form_open('', 'class="form-horizontal"'); ?>
                                        <fieldset>
                                            <?php if (null != $id): ?>
                                                <p class="warngin-msg password-warn">! Note You can keep password fields empty
                                                    if you don't need to change password.</p>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <label for="username-3" class="control-label col-md-3"><?= lang('username'); ?></label>
                                                <div class="col-md-5">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'username',
                                                        'class'         => 'form-control',
                                                        'id'            => 'username-3',
                                                        'value'         => set_value('username', $agent->username),
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('username'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->


                                            <!-- Default Language -->
                                            <div class="form-group">
                                                <label for="user_language" class="control-label col-md-3"><?= lang('default_language'); ?></label>
                                                <div class="col-md-5">
                                                    <select name="user_language" id="user_language" class="form-control">
                                                        <option value="en" <?php if ($agent->user_language == 'en') echo 'selected'; ?>>English</option>
                                                        <option value="ar" <?php if ($agent->user_language == 'ar') echo 'selected'; ?>>Arabic</option>
                                                    </select>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <!-- Nationality -->
                                            <div class="form-group">
                                                <label for="nationality_id" class="control-label col-md-3"><?= lang('nationality'); ?></label>
                                                <div class="col-md-5">
                                                    <?php
                                                    echo form_dropdown('nationality_id', $nationalities,  $agent->nationality_id,'class="form-control"');
                                                    echo form_error('nationality_id');
                                                    ?>
                                                </div>
                                            </div><!-- ./form-group -->


                                            <!-- representative -->
                                            <div class="form-group">
                                                <label for="representative_id" class="control-label col-md-3">
                                                    <?= lang('representative'); ?>
                                                </label>
                                                <div class="col-md-5">
                                                    <?php
                                                    $representative_id = (isset($representative->representative_id)) ? $representative->representative_id : false;
                                                    echo form_dropdown('representative_id', $representatives, $representative_id, 'class="form-control"');
                                                    echo form_error('representative_id');
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="password-3" class="control-label col-md-3"><?= lang('address'); ?></label>
                                                <div class="col-md-5">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'address',
                                                        'class'         => 'form-control',
                                                        'id'            => 'address',
                                                        'value'         => set_value('address', $agent->address),
                                                    ];
                                                    ?>
                                                    <?= form_textarea($data); ?>
                                                    <?php echo form_error('address'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->


                                            <div class="form-group">
                                                <label for="password-3" class="control-label col-md-3"><?= lang('email'); ?></label>
                                                <div class="col-md-5">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'email',
                                                        'class'         => 'form-control',
                                                        'id'            => 'email',
                                                        'value'         => set_value('email', $agent->email),
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('email'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->




                                            <div class="form-group">
                                                <label for="password-3" class="control-label col-md-3"><?= lang('password'); ?></label>
                                                <div class="col-md-5">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'password',
                                                        'class'         => 'form-control',
                                                        'id'            => 'password-3',
                                                    ];
                                                    ?>
                                                    <?= form_password($data); ?>
                                                    <?php echo form_error('password'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->


                                            <div class="form-group">
                                                <label for="password_confirm_3" class="control-label col-md-3"><?= lang('confirm_password'); ?></label>
                                                <div class="col-md-5">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'password_confirm',
                                                        'class'         => 'form-control',
                                                        'id'            => 'password_confirm_3',
                                                    ];
                                                    ?>
                                                    <?= form_password($data); ?>
                                                    <?php echo form_error('password_confirm'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->



                                            <div class="box-footer">
                                                <div class="col-md-6 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                                </div>
                                            </div>

                                        </fieldset>
                                        <!--                                   </div>-->
                                        </form>
                                    </div>

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