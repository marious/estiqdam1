<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Worker Nationality / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> Worker Nationality</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'worker_nationality'; ?>">Worker Nationality</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('worker_nationality/add'); ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> Worker Nationality</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="name_in_english" class="control-label col-md-3">Nationality In English</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'nationality_in_english',
                                                        'class'         => 'form-control',
                                                        'id'            => 'nationality_in_english',
                                                        'value'         => set_value('nationality_in_english', $worker_nationality->nationality_in_english),
                                                        'placeholder'   => 'Nationality In English',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('nationality_in_english'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="name_in_arabic" class="control-label col-md-3">Nationality In Arabic</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'nationality_in_arabic',
                                                        'class'         => 'form-control',
                                                        'id'            => 'nationality_in_arabic',
                                                        'value'         => set_value('nationality_in_arabic', $worker_nationality->nationality_in_arabic),
                                                        'placeholder'   => 'Nationality In Arabic',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('nationality_in_arabic'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->


                                            <div class="form-group">
                                                <label for="country_in_arabic" class="control-label col-md-3">Country Name In Arabic</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name' => 'country_name_in_arabic',
                                                        'class' => 'form-control',
                                                        'id' => 'country_name_in_arabic',
                                                        'value' => set_value('country_name_in_arabic', $worker_nationality->country_name_in_arabic),
                                                        'placeholder' => 'Country Name in arabic',
                                                    ];
                                                    echo form_input($data);
                                                    echo form_error('country_name_in_arabic');
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="country_name_in_english" class="control-label col-md-3">Country Name In English</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name' => 'country_name_in_english',
                                                        'class' => 'form-control',
                                                        'id' => 'country_name_in_english',
                                                        'value' => set_value('country_name_in_english', $worker_nationality->country_name_in_english),
                                                        'placeholder' => 'Country Name in Engish',
                                                    ];
                                                    echo form_input($data);
                                                    echo form_error('country_name_in_english');
                                                    ?>
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