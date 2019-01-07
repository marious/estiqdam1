<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('departure_airports'); ?> / <?php echo (null == $id) ? lang('add_new') : lang('edit'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'departure_airports'; ?>"><?= lang('departure_airports'); ?></a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('departure_airports/add'); ?>"><?= lang('add_new'); ?></a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> <?= lang('departure_airports'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="name_in_english" class="control-label col-md-3"><?= lang('name_in_english') ?></label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_english',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_english',
                                                        'value'         => set_value('name_in_english', $departure_airport->name_in_english),
                                                        'placeholder'   => lang('name_in_english'),
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name_in_english'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="name_in_arabic" class="control-label col-md-3"><?= lang('name_in_arabic'); ?></label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'name_in_arabic',
                                                        'class'         => 'form-control',
                                                        'id'            => 'name_in_arabic',
                                                        'value'         => set_value('name_in_arabic', $departure_airport->name_in_arabic),
                                                        'placeholder'   => lang('name_in_arabic'),
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('name_in_arabic'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="" class="control-label col-md-3"><?= lang('country'); ?></label>
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