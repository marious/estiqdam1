<form action="" class="form-horizontal" method="post">
    <fieldset>
        <?php //if (null != $id): ?>
<!--            <p class="warngin-msg password-warn">! Note You can keep password fields empty-->
<!--                if you don't need to change password.</p>-->
        <?php //endif; ?>
        <div class="form-group">
            <label for="username" class="control-label col-md-3"><?= lang('username'); ?></label>
            <div class="col-md-5">

                <?php
                $data = [
                    'name'          => 'username',
                    'class'         => 'form-control',
                    'id'            => 'username',
                    'value'         => set_value('username', $staff->username),
                    'placeholder'   => 'Username',
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
                    <option value>-- <?= lang('select'); ?> --</option>
                    <option value="ar" <?php if ($staff->user_language == 'ar') echo 'selected';?>>Arabic</option>
                    <option value="en" <?php if ($staff->user_language == 'en') echo 'selected';?>>English</option>
                </select>
            </div>
        </div><!-- ./ form-group -->
        <!-- ./ user type -->
        <div class="form-group">
            <label for="access_id" class="control-label col-md-3"><?= lang('user_type') ?></label>
            <div class="col-md-5">
                <select name="access_id" id="access_id" class="form-control">
                    <option value>-- <?= lang('select'); ?> --</option>
                    <option value="1" <?php if ($staff->access_id == 1) echo 'selected'; ?>>Staff</option>
                    <option value="2" <?php if ($staff->access_id == 2) echo 'selected'; ?>>Admin</option>
                </select>
                <?php echo form_error('access_id'); ?>
            </div>
        </div>


        <div class="form-group">
            <label for="password" class="control-label col-md-3"><?= lang('password'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'          => 'password',
                    'class'         => 'form-control',
                    'id'            => 'password',
                    'placeholder'   => 'Password',
                ];
                ?>
                <?= form_password($data); ?>
                <?php echo form_error('password'); ?>
            </div>
        </div><!-- ./ form-group -->


        <div class="form-group">
            <label for="password_confirm" class="control-label col-md-3"><?= lang('confirm_password'); ?></label>
            <div class="col-md-5">
                <?php
                $data = [
                    'name'          => 'password_confirm',
                    'class'         => 'form-control',
                    'id'            => 'password_confirm',
                    'placeholder'   => 'Confirm Password',
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