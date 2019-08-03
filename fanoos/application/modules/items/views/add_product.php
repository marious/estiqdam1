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

                    <!-- sales price -->
                    <div class="form-group">
                        <label for="sales_price" class="col-sm-2 control-label"><?= lang('sales_price') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" id="sales_price" autocomplete="off" class="form-control" name="sales_price"
                                   value="<?= set_value('sales_price', $product->sales_price) ?>">
                            <?= form_error('sales_price', '<div class="error">', '</div>'); ?>

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
