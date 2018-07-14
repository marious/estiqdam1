<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Credit Card / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> Transfer Type</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'transfer_types'; ?>">Transfer Type</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('transfer_types/add'); ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"> Transfer Type</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="type" class="control-label col-md-3">Transfer Type</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'type',
                                                        'class'         => 'form-control',
                                                        'id'            => 'type',
                                                        'value'         => set_value('type', $transfer_type->type),
                                                        'placeholder'   => 'Transfer Type',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('type'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->


                                            <div class="form-group">
                                                <label for="parent_id" class="control-label col-md-3">Category</label>
                                                <div class="col-md-8">
                                                    <select name="parent_id" id="parent_id" class="form-control">
                                                        <option value="0">None</option>
                                                        <?php if ($transfer_types && count($transfer_types)): ?>
                                                        <?php foreach ($transfer_types as $type): ?>
                                                                <option value="<?= $type->id; ?>"  <?php if ($type->id == $transfer_type->parent_id) {echo 'selected';} ?>><?= $type->type; ?></option>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>




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