<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?= lang('income_categories') ?></h3>
                <div class="box-tools" style="padding-top: 5px">
                    <div class="input-group input-group-sm" >
                        <?php if (in_array('add_income_category', $logged_in_user_permissions)): ?>
                        <a  data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
                            href="<?php echo base_url()?>transactions/add_income_category" class="btn btn-sm bg-blue-active btn-flat">
                            <i class="fa fa-plus"></i> <?= lang('add_income') ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="box-body">

                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>


                <div class="row">
                    <div class="col-md-12">
                        <div id="msg"></div>

                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="active"><?= lang('name') ?></th>
                                    <th class="active"><?= lang('description') ?></th>
                                    <th class="active" style="width: 125px"><?= lang('actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (is_array($categories) && count($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?= $category->name ?></td>
                                        <td><?= $category->description ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <?php if (in_array('edit_income_category', $logged_in_user_permissions)): ?>
                                                <a data-target="#modalSmall" title="View" data-placement="top" data-toggle="modal"
                                                   class="btn btn-xs btn-default" href="<?php echo base_url()?>transactions/add_income_category/<?php echo $category->id?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (in_array('delete_income_category', $logged_in_user_permissions)): ?>
                                                <a class="btn btn-xs btn-danger" onClick="return confirm('Are you sure you want to delete?')"
                                                   href="<?php echo site_url('transactions/delete_category/'.$category->id) ?>"> <i class="glyphicon glyphicon-trash"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>