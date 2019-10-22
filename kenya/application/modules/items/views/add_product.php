<div class="row">
    <div class="col-md-12">



        <form class="form-horizontal" action="<?= site_url('items/add_product/' . $id); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="box box-info">



                <div class="box-body">



                    <!-- EN Item Code -->
                    <div class="form-group">
                        <label for="item_code" class="col-sm-2 control-label"><?= lang('item_code') ?> <span>(Auto)</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="item_code" autocomplete="off" class="form-control" name="item_code"
                                   value="<?= set_value('item_code', $product->item_code) ?>" disabled>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?= lang('name') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="name" autocomplete="off" class="form-control" name="name"
                                   value="<?= set_value('name', $product->name) ?>">
                            <?= form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <!-- category -->
                    <div class="form-group">
                        <label for="category_id" class="col-sm-2 control-label"><?= lang('category') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option value=""><?= lang('please_select') ?>...</option>
                                <?php if (is_array($categories) && count($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                        <?php $selected = $category->id == $product->category_id ? true : false; ?>
                                        <option value="<?= $category->id ?>" <?= set_select('category_id', $category->id, $selected) ?>><?= $category->category ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?= form_error('category_id', '<div class="error">', '</div>'); ?>
                            <a href="#" data-toggle="modal" data-target="#myModal">+ <?= lang('add_category') ?></a>
                        </div>
                    </div>


                    <!-- cost -->
                    <div class="form-group">
                        <label for="purchase_cost" class="col-sm-2 control-label"><?= lang('purchase_cost') ?> <span class="error">*</span></label>
                        <div class="col-sm-1">
                            <input type="text" id="purchase_cost" autocomplete="off" class="form-control" name="purchase_cost"
                                   value="<?= set_value('purchase_cost', $product->purchase_cost) ?>">
                            <?= form_error('cost', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <!-- sales price -->
                    <div class="form-group">
                        <label for="sales_price" class="col-sm-2 control-label"><?= lang('sales_price') ?> <span class="error">*</span></label>
                        <div class="col-sm-1">
                            <input type="text" id="sales_price" autocomplete="off" class="form-control" name="sales_price"
                                   value="<?= set_value('sales_price', $product->sales_price) ?>">
                            <?= form_error('sales_price', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>



                    <!-- Retail unit -->
                    <div class="form-group">
                        <label for="retail_unit" class="col-sm-2 control-label"><?= lang('retail_unit') ?></label>
                        <div class="col-sm-1">
                            <select name="retail_unit" id="retail_unit" class="form-control">
                                <?php if (is_array($units) && count($units)): ?>
                                <option value=""></option>
                                <?php foreach ($units as $unit): ?>
                                        <?php $selected = $product->retail_unit == $unit->id ? true : false; ?>
                                        <option value="<?= $unit->id ?>" <?= set_select('retail_unit', $unit->id, $selected) ?>><?= $unit->name ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?= form_error('retail_unit', '<div class="error">', '</div>'); ?>

                        </div>

                        <label for="retail_equal_amount" class="col-sm-2 control-label"><?= lang('equal_amount') ?></label>
                       <div class="col-sm-1">
                           <input type="number" class="form-control" name="retail_qty" id="retail_equal_amount"
                                  value="<?= set_value('retail_qty', $product->retail_qty) ?>" autocomplete="off">
                           <?= form_error('retail_qty', '<div class="error">', '</div>'); ?>
                       </div>


                        <label for="retail_price" class="col-sm-1 control-label"><?= lang('price') ?></label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="retail_price" id="retail_price"
                                   value="<?= set_value('retail_price', $product->retail_price) ?>" autocomplete="off">
                            <?= form_error('retail_price', '<div class="error">', '</div>'); ?>

                        </div>


                    </div>


                    <!-- Wholesale unit -->
                    <div class="form-group">
                        <label for="wholesale_unit" class="col-sm-2 control-label"><?= lang('wholesale_unit') ?></label>
                        <div class="col-sm-1">
                            <select name="wholesale_unit" id="" class="form-control">
                                <?php if (is_array($units) && count($units)): ?>
                                    <option value=""></option>
                                    <?php foreach ($units as $unit): ?>
                                        <?php $selected = $unit->id == $product->wholesale_unit ? true : false; ?>
                                        <option value="<?= $unit->id ?>" <?= set_select('wholesale_unit', $unit->id, $selected) ?>><?= $unit->name ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?= form_error('wholesale_unit', '<div class="error">', '</div>'); ?>
                        </div>

                        <label for="wholesale_equal_amount" class="col-sm-2 control-label"><?= lang('equal_amount') ?></label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" name="wholesale_qty" id="wholesale_equal_amount"
                                   value="<?= set_value('wholesale_qty', $product->wholesale_qty) ?>" autocomplete="off">
                            <?= form_error('wholesale_qty', '<div class="error">', '</div>'); ?>
                        </div>


                        <label for="wholesale_price" class="col-sm-1 control-label"><?= lang('price') ?></label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="wholesale_price" id="wholesale_price"
                                   value="<?= set_value('wholesale_price', $product->wholesale_price) ?>" autocomplete="off">
                            <?= form_error('wholesale_price', '<div class="error">', '</div>'); ?>

                        </div>


                    </div>



                    <!-- description -->
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label"><?= lang('description') ?> <span class="error"></span></label>
                        <div class="col-sm-6">
                            <textarea name="description" id="description" rows="3" class="form-control"><?= set_value('description', $product->description) ?></textarea>
                        </div>
                    </div>


                    <hr>

                    <?php if (is_array($taxes) && count($taxes)): ?>
                    <div class="form-group">
                        <label for="taxes" class="col-sm-2 control-label"><?= lang('taxes') ?></label><br>
                       <div class="permission-list">
                           <ul class="permission-list">
                               <?php foreach ($taxes as $tax): ?>
                               <?php $checked = ''; ?>
                                    <?php foreach ($item_taxes as $item_tax) {
                                        if ($tax->id == $item_tax) {
                                            $checked= 'checked';
                                        }
                                   } ?>
                                   <li>
                                       <label><input type="checkbox" value="<?= $tax->id ?>" name="tax[]" class="minimal"
                                            <?= set_checkbox('tax[]', $tax->id) ?> <?=$checked?>>&nbsp; <?= $tax->name; ?></label>
                                   </li>
                               <?php endforeach; ?>
                           </ul>
                       </div>
                    </div>
                    <?php endif; ?>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left"><?= lang('save'); ?></button>
                            <a href="<?= site_url('items/products') ?>" class="btn btn-default pull-left m-l-10"><?= lang('cancel'); ?></a>

                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= lang('add_category') ?></h4>
            </div>
            <div class="modal-body">
                <div id="msgModal"></div>
                <form class="form-horizontal" action="<?php echo site_url("items/save_category") ?>" id="form-category">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?= lang('category') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="category" id="p_category" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="javascript::" class="btn btn-default" onclick="saveCategory()"><?= lang('save') ?></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
            </div>
        </div>

    </div>
</div>


<script>
    $('#myModal').on('hidden.bs.modal', function() {
       location.reload();
    });
</script>

