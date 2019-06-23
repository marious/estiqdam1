<div class="row">
    <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">
                    <table id="roles-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?= lang('permissions') ?></th>
                                <th><?= lang('description') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (is_array($permissions) && count($permissions)): ?>
                        <?php foreach ($permissions as $permission): ?>
                        <tr>
                          <td><?= $permission->name; ?></td>
                          <td><?= $permission->description; ?></td>
                        </tr>
<?php endforeach; ?>
<?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
    </div>
</div>


