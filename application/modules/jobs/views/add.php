<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Jobs / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> Job Name</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'jobs'; ?>">Job</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('jobs/add'); ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> Job Name</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="name_in_english" class="control-label col-md-3">Job In English</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_english',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_english',
                                                        'value'         => set_value('name_in_english', 
                                                            $job->name_in_english),
                                                        'placeholder'   => 'Job Name In English',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name_in_english'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="name_in_arabic" class="control-label col-md-3">Job Name In Arabic</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_arabic',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_arabic',
                                                        'value'         => set_value('name_in_arabic', $job->name_in_arabic),
                                                        'placeholder'   => 'Job Name In Arabic',
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