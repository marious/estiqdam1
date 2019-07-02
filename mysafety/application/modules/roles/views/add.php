<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="<?= site_url('roles/add/'.$id); ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
                    <!-- Role name -->
                    <div class="form-group">
                        <label for="role_name" class="col-sm-2 control-label"><?= lang('role_name') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="role_name" autocomplete="off" class="form-control" name="role_name"
                                   value="<?= set_value('role_name', $group->name); ?>">
                            <?= form_error('role_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- role description -->
                    <div class="form-group">
                        <label for="role_description" class="col-sm-2 control-label"><?= lang('role_description') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <textarea name="role_description" class="form-control" cols="30" rows="4" id="role_description"><?= set_value('role_description', $group->description) ?></textarea>
                            <?= form_error('role_description', '<div class="error">', '</div>') ?>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="">Select Permission</label>
                    </div>

                    <div class="permission-list">
                        <?php
                        if ($id) {
                            $permissions_id_arr = $this->Role_model->get_permissions_id_by_group($id);
                        }
                        ?>
                        <ul>
                            <?php foreach ($this->db->select('display_name')->from('permissions')->group_by('display_name')->get()->result() as $perm): ?>
                                <li>
                                        <label><input type="checkbox" class="permission-group minimal">
                                            &nbsp;&nbsp;<strong><?= ucfirst(str_replace('_', ' ', $perm->display_name)) ?></strong></label>
                                    <ul>
                                        <?php foreach ($this->Role_model->get_permissions()->where('display_name', $perm->display_name)->get()->result() as $permission): ?>
                                            <li>
                                                <label><input type="checkbox" class="child minimal" name="permissions[]" value="<?= $permission->id ?>" <?php if ($id && in_array($permission->id, $permissions_id_arr)) echo 'checked'; ?>>
                                                    &nbsp;&nbsp;<?= ucwords(str_replace('_', ' ', $permission->name)); ?>
                                                </label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>

                            <?php endforeach;; ?>
                        </ul>

                    </div>





                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left"><?= lang('save'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>