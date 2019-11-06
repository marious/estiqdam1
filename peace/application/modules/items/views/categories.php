<div class="row">

    <div class="col-md-12">

        <!-- view messages -->
        <?= message_box('success') ?>
        <?= message_box('error') ?>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?= lang('categories_list') ?>
                </h3>
            </div>

            <?= form_open(site_url('items/save_product_category'), ['class' => 'form-horizontal']) ?>

            <div class="form-group margin">
                <label class="col-sm-3 control-label" for="p_category"><?= lang('category') ?><span class="required">*</span></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="category" id="p_category"
                        value="<?= !empty($category) ? $category->category : ''?>" required>
                </div>
            </div>


            <input type="hidden" name="category_id" value="<?= !empty($category) ? $category->id : '' ?>">

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-flat btn-md"><?= lang('save') ?></button>
                </div>
            </div>

            <?= form_close() ?>

            <br>
            <br>
            <br>


            <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?= lang('num') ?></th>
                            <th><?= lang('category') ?></th>
                            <th><?= lang('actions') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $i = 1; ?>
                    <?php if (is_array($categories) && count($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $category->category ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-default" href="<?php echo base_url().'items/categories/'. $category->id ?>" ><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-xs btn-danger delete"  data-href="<?php echo base_url().'items/delete_category/'. $category->id ?>" data-target="#confirm-delete" data-toggle="modal"><i class="glyphicon glyphicon-trash"></i></a></div>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>


            </div>
            </div>

        </div>

    </div>

</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>