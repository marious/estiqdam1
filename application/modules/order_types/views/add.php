<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Order Types / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> Order Type</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'order_types'; ?>">Order Types</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('order_types/add'); ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Order Type</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="name_in_english" class="control-label col-md-3">Order Type In English</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_english',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_english',
                                                        'value'         => set_value('name_in_english', 
                                                            $order_type->name_in_english),
                                                        'placeholder'   => 'Order Type Name In English',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name_in_english'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="name_in_arabic" class="control-label col-md-3">Order Type In Arabic</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_arabic',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_arabic',
                                                        'value'         => set_value('name_in_arabic', $order_type->name_in_arabic),
                                                        'placeholder'   => 'Order Type Name In Arabic',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name_in_arabic'); ?>
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

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div>
    </div>
</section>