<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Representatives / Add  New Representative</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'representatives'; ?>">Representatives</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('representatives/add'); ?>">Add New Representative</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Representative</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>

                                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="name" class="control-label col-md-3">Representative Name</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name',
                                                        'value'         => set_value('name', $representative->name),
                                                        'placeholder'   => 'Representative Name',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name'); ?>
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