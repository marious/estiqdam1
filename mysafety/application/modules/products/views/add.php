<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="<?= site_url('products/add/'.$id); ?>" method="post" enctype="multipart/form-data">
            <div class="box box-info">
                <div class="box-body">
                    <!-- EN category name -->
                    <div class="form-group">
                        <label for="en_name" class="col-sm-2 control-label"><?= lang('en_product_name') ?> <span>*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="en_name" autocomplete="off" class="form-control" name="en_name"
                                   value="<?php echo set_value('en_name', transText($product->name, 'en')) ?>">
                            <?php echo form_error('en_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!-- AR category name -->
                    <div class="form-group">
                        <label for="ar_name" class="col-sm-2 control-label"><?= lang('ar_product_name') ?> <span class="error">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="ar_name" autocomplete="off" class="form-control" name="ar_name"
                                   value="<?php echo set_value('ar_name', transText($product->name, 'ar')); ?>">
                            <?php echo form_error('ar_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <!-- Service -->
                    <div class="form-group">
                        <label for="service_id" class="col-sm-2 control-label"><?= lang('service') ?> <span class="error">*</span></label>
                        <div class="col-sm-4">
                            <select name="category_id" id="service_id" class="form-control">
                                <option value="0">-- <?= lang('select_category'); ?> --</option>
                                <?php if ( is_array($categories) && count($categories) ): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->id; ?>"  <?php if ($product->category_id == $category->id) echo 'selected';;?> > <?= transText($category->name, get_current_lang()); ?> </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?= form_error('category_id', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <!-- en description -->
                    <div class="form-group">
                        <label for="en_description" class="col-sm-2 control-label"><?= lang('en_description') ?> <span class="error">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="en_description" id="editor1"><?php echo set_value('en_description', transText($product->description, 'en')); ?></textarea>
                            <?php echo form_error('en_description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <!-- ar description -->
                    <div class="form-group">
                        <label for="ar_description" class="col-sm-2 control-label"><?= lang('ar_description') ?> <span>*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="ar_description" id="editor2"><?php echo set_value('ar_description', transText($product->description, 'ar')); ?></textarea>
                            <?php echo form_error('ar_description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><?= lang('image'); ?> <span>*</span></label>
                        <div class="col-sm-9" style="padding-top:5px">
                            <input type="file" name="image">(Only jpg, jpeg, gif and png are allowed)
                        </div>
                    </div>




                    <!-- meta-title -->

                    <!-- meta-keywords -->


                    <!-- meta-description -->


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success pull-left" name="form1"><?= lang('save'); ?></button>
                            <a href="<?= site_url('products/all') ?>" class="btn btn-default m-l-10"><?= lang('cancel') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
