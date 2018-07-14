<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Departure Airports / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> Departure Airport</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'departure_airports'; ?>">Departure Airports</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('departure_airports/add'); ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> Departure Airports</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="name_in_english" class="control-label col-md-3">Name In English</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_english',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_english',
                                                        'value'         => set_value('name_in_english', $departure_airport->name_in_english),
                                                        'placeholder'   => 'Name In English',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name_in_english'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="name_in_arabic" class="control-label col-md-3">Name In Arabic</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_arabic',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_arabic',
                                                        'value'         => set_value('name_in_arabic', $departure_airport->name_in_arabic),
                                                        'placeholder'   => 'Name In Arabic',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name_in_arabic'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="" class="control-label col-md-3">Country</label>
                                                <div class="col-md-8">
                                                    <select name="nationality_id" id="" class="form-control">
                                                        <option value="">-- <?= lang('select'); ?> --</option>
                                                        <?php foreach ($countries as $country): ?>
                                                            <option value="<?= $country->id; ?>" <?php if ($departure_airport->nationality_id == $country->id) {echo 'selected';} ?>>
                                                                <?= $country->country_name_in_arabic; ?>
                                                            </option>
                                                        <?php  endforeach; ?>
                                                    </select>
                                                    <?php echo form_error('nationality_id'); ?>
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