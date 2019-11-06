<div class="row">
    <div class="col-md-12">

            <div class="box box-info">
                <div class="box-body">


                    <table id="roles-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('name') ?></th>
                                <th><?= lang('description') ?></th>
                                <th><?= lang('permissions') ?></th>
                                <th><?= lang('actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach ($roles as $role): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $role->name; ?></td>
                            <td><?= $role->description; ?></td>
                            <td class="group-permissions"><?= $this->Role_model->format_permissions_for_view($this->Role_model->get_permissions_for_group($role->id)) ?></td>
                            <td>
                                <a href="<?= site_url('roles/role/' . $role->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                <?= draw_actions_button(site_url('roles/edit/' . $role->id), site_url('roles/delete/' . $role->id), 'roles'); ?>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>


    </div>
</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('delete_conf') ?></h4>
            </div>
            <div class="modal-body">
                <p><?= lang('delete_conf_msg') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
                <a class="btn btn-danger btn-ok"><?= lang('delete') ?></a>
            </div>
        </div>
    </div>
</div>