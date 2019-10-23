<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="<?= site_url('users/add/'.$id); ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
<?= csrf_field() ?>
                    <?php if (isset($note)): ?><p class="text-green note-text"><?= $note; ?></p><?php endif; ?>
                    <!-- username -->
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label"><?= lang('username') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="username" autocomplete="off" class="form-control" name="username"
                                   value="<?php echo set_value('username', $user->username) ?>">
                            <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <!-- email -->
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"><?= lang('email') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="email" id="email" autocomplete="off" class="form-control" name="email"
                                   value="<?php echo set_value('email', $user->email) ?>">
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <!-- password -->
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label"><?= lang('password'); ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="password" name="password" class="form-control" id="password">
                            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- password confirmation -->
                    <div class="form-group">
                        <label for="conf_password" class="col-sm-2 control-label"><?= lang('conf_password'); ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="password" name="conf_password" class="form-control" id="conf_password">
                            <?php echo form_error('conf_password', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                       

                      
                         <label for="role_group" class="control-label col-sm-2"><?= lang('role_group') ?> <span class="error">*</span></label>

                    <div class="col-sm-6">
                    <?php
                    $user_groups_arr = [];
                    $checked = '';
                    if ($user->id) {
                        $user_groups = $this->ion_auth->get_users_groups($user->id)->result();
                        foreach($user_groups as $group) {
                            $user_groups_arr[] = $group->id;
                        }
                    }
                     ?>
                    <?php if (is_array($groups) && count($groups)): ?>
                    <?php foreach ($groups as $group): ?>
                    <?php
                    if (in_array($group->id, $user_groups_arr)) {
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    }
                    ?>
                   <label class="block-label"><input type="checkbox" value="<?= $group->id ?>" class="minimal" name="role_group[]" <?= $checked; ?>>  &nbsp;&nbsp;<?= $group->name; ?></label>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="error"><?= form_error('role_group') ?></div>
                    </div>
                    </div>
                    

                    

<br>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left" name="form1"><?= lang('save'); ?></button>
                            &nbsp;&nbsp;
                            <a href="<?= site_url('users/all') ?>" class="btn btn-default"><?= lang('cancel') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

