<section>
    <?= form_open_multipart(); ?>
    <div class="container-fluid worker-entry">
        <div class="row">
            <div class="content worker-agent-info">
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'agent_worker'; ?>">Workers</a>
                            </li>
                            <li class="active">
                                <a href="">Add New</a>
                            </li>

                            <div class="col-md-12">
                                <div class="panel panel-default m-t">
                                    <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> BIO DATA</div>
                                    <div class="panel-body">
                                        <div class="tab-content m-t">

                                            <div class="col-md-8">
                                                <div class="form-horizontal">
                                                    <fieldset>

                                                        <!-- Agent Office -->
                                                        <div class="form-group">
                                                            <label for="agent_id" class="control-label col-md-3">Agent Office</label>
                                                            <div class="col-md-3">
                                                                <select name="agent_id" id="agent_id" class="form-control">
                                                                    <option value="">-- Select --</option>
                                                                    <?php foreach ($agents as $agent): ?>
                                                                        <option value="<?= $agent->id; ?>" <?php if ($worker->agent_id == $agent->id) echo 'selected'; ?>><?= $agent->username; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <?php echo form_error('agent_id'); ?>
                                                            </div>
                                                        </div>

                                                        <!-- job -->
                                                        <div class="form-group">
                                                            <label for="job" class="control-label col-md-3">POSITION APPLIED</label>
                                                            <div class="col-md-3">
                                                                <select class="form-control" name="job_id">
                                                                    <option value="">-- Select --</option>
                                                                    <?php foreach ($jobs as $job): ?>
                                                                        <option value="<?= $job->id; ?>" <?php if ($worker->job_id == $job->id) {echo 'selected';} ?>><?= $job->name_in_english; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <?= form_error('job_id'); ?>
                                                            </div>
                                                        </div>

                                                        <!-- MONTHLY SALARY -->
                                                        <div class="form-group">
                                                            <label for="salary" class="control-label col-md-3">MONTHLY SALARY</label>
                                                            <div class="col-md-3">
                                                                <input type="number" class="form-control" name="salary" id="salary" value="<?=  set_value('salary', $worker->salary); ?>">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="col-md-8 col-md-push-2">
                                                                <?= form_error('salary'); ?>
                                                            </div>
                                                        </div>

                                                        <!-- CONTRACT PERIOD -->
                                                        <div class="form-group">
                                                            <label for="contract_period" class="control-label col-md-3">Contract Period</label>
                                                            <div class="col-md-3">
                                                                <input type="text" class="form-control" name="contract_period" value="2 Years" disabled>
                                                                <?= form_error('contract_period'); ?>
                                                            </div>
                                                        </div>

                                                        <!-- NAME -->
                                                        <div class="form-group">
                                                            <label for="name" class="control-label col-md-3">Name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name', $worker->name) ?>">
                                                                <?= form_error('name'); ?>
                                                            </div>
                                                        </div>

                                                        <!-- name in arabic -->
                                                        <div class="form-group">
                                                            <label for="name_in_arabic" class="control-label col-md-3">Name In Arabic</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="name_in_arabic" id="name_in_arabic" value="<?= set_value('name_in_arabic', $worker->name_in_arabic); ?>">
                                                                <?= form_error('name_in_arabic'); ?>
                                                            </div>
                                                        </div>

                                                        <?php if ($worker->nationality_id == 11): ?>

                                                        <div class="form-group">
                                                            <label for="worker_phone" class="control-label col-md-3">Worker Phone</label>
                                                            <div class="col-md-3">
                                                                <input type="text" name="worker_phone" id="worker_phone" value="<?= set_value('worker_phone', $worker->worker_phone); ?>" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address" class="control-label col-md-3">Address In philippine</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="address" id="address" value="<?= set_value('address', $worker->address); ?>">
                                                            </div>
                                                        </div>

                                                        <!-- next kin address -->
                                                            <div class="form-group">
                                                                <label for="next_kin_name" class="control-label col-md-3">Next Kin Name</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" name="next_kin_name" id="next_kin_name" value="<?= set_value('next_kin_name', $worker->next_kin_name) ?>">
                                                                </div>
                                                            </div>

                                                            <!-- next kin address -->
                                                            <div class="form-group">
                                                                <label for="next_kin_address" class="control-label col-md-3">Next Kin Address</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" name="next_kin_address" id="next_kin_address" value="<?= set_value('next_kin_address', $worker->next_kin_address) ?>">
                                                                </div>
                                                            </div>

                                                            <!-- next kin phone -->
                                                            <div class="form-group">
                                                                <label for="next_kin_phone" class="control-label col-md-3">Next Kin Phone</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="next_kin_phone" id="next_kin_phone" value="<?= set_value('next_kin_phone', $worker->next_kin_phone) ?>">
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- worker image -->
                                                        <div class="form-group">
                                                            <label for="image" class="col-sm-3   control-label"><?=  lang('worker_image'); ?></label>
                                                            <div class="col-sm-3">
                                                                <input type="file" id="image" name="image" class="form-control">
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                    <!--                                   </div>-->
                                                </div>
                                            </div>

                                            <?php if ($worker->image != ''): ?>
                                                <div class="col-md-3">
                                                    <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" alt="" class="img-thumbnail" style="height: 300px;">
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="panel panel-default m-t worker-agent-panel">
                                    <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Applicant Details</div>
                                    <div class="panel-body">
                                        <div class="tab-content m-t">

                                            <div class="form-horizontal">
                                                <fieldset>
                                                    <!-- worker name in english -->

                                                    <!-- religion -->
                                                    <div class="form-group">
                                                        <label for="religion" class="control-label col-md-4"><?= lang('religion') ?></label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            echo '<select class="form-control" name="religion" id="religion">';
                                                            echo '<option value="">-- SELECT --</option>';
                                                            foreach ($religions as $religion) {
                                                                $selected =  ($worker->religion == $religion->id) ? 'selected' : '';
                                                                echo '<option value="'.$religion->id.'" '.$selected.'>'.$religion->religion.'</option>';
                                                            }
                                                            echo '</select>';
                                                            echo form_error('religion');
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <!-- Marital status -->
                                                    <div class="form-group">
                                                        <label for="marital_status" class="control-label col-md-4"><?= lang('marital_status'); ?></label>
                                                        <div class="col-md-8">
                                                            <select name="marital_status" id="marital_status" class="form-control">
                                                                <option value="">-- SELECT --</option>
                                                                <option value="1" <?php if ($worker->marital_status == '1') echo 'selected'; ?>>SINGLE</option>
                                                                <option value="2" <?php if ($worker->marital_status == '2') {echo 'selected';} ?>>MARRIED</option>
                                                            </select>
                                                            <?= form_error('marital_status'); ?>
                                                        </div>
                                                    </div>

                                                    <!-- Heights -->
                                                    <div class="form-group">
                                                        <label for="height" class="control-label col-md-4"><?= lang('height') ?></label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            $data = [
                                                                'name' => 'height',
                                                                'class' => 'form-control',
                                                                'id' => 'height',
                                                                'value' => set_value('height', $worker->height),
                                                                'type' => 'number',
                                                            ];
                                                            echo form_input($data);
                                                            ?>
                                                            <?php
                                                            echo form_error('height');
                                                            ?>
                                                        </div>
                                                    </div>


                                                    <!-- Weight -->
                                                    <div class="form-group">
                                                        <label for="weight" class="control-label col-md-4"><?= lang('weight') ?></label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            $data = [
                                                                'name' => 'weight',
                                                                'class' => 'form-control',
                                                                'id' => 'weight',
                                                                'value' => set_value('weight', $worker->weight),
                                                                'type' => 'number',
                                                            ];
                                                            echo form_input($data);
                                                            ?>
                                                            <?php
                                                            echo form_error('weight');
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <!-- qualification -->
                                                    <div class="form-group">
                                                        <label for="qualification" class="control-label col-md-4"><?= lang('qualification') ?></label>
                                                        <div class="col-md-8">
                                                            <?php
                                                            $data = [
                                                                'name' => 'qualification',
                                                                'class' => 'form-control',
                                                                'id' => 'qualification',
                                                                'value' => set_value('qualification', $worker->qualification),
                                                            ];
                                                            echo form_input($data);
                                                            echo form_error('qualification');
                                                            ?>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!--                                   </div>-->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- ./col-md-5 -->

                            <div class="col-md-4">
                                <div class="panel panel-default m-t worker-agent-panel">
                                    <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Passport Details And Ticket</div>
                                    <div class="panel-body">
                                        <div class="tab-content m-t">

                                            <div class="form-horizontal">
                                                <fieldset>
                                                    <!-- worker sur name -->
                                                    <div class="form-group">
                                                        <label for="first_name" class="control-label col-md-5"><?= lang('first_name') ?></label>
                                                        <div class="col-md-7">
                                                            <?php
                                                            $data = [
                                                                'name'          => 'first_name',
                                                                'class'         => 'form-control',
                                                                'id'            => 'first_name',
                                                                'value'         => set_value('first_name', $worker->first_name),
                                                            ];
                                                            ?>
                                                            <?= form_input($data); ?>
                                                            <?php echo form_error('first_name'); ?>
                                                        </div>
                                                    </div><!-- ./ form-group -->

                                                    <?php if ($worker->nationality_id == 11 || $worker->nationality_id == 21): ?>
                                                        <div class="form-group">
                                                            <label for="middle_name" class="control-label col-md-5"><?= lang('middle_name') ?></label>
                                                            <div class="col-md-7">
                                                                <?php
                                                                $data = [
                                                                    'name'          => 'middle_name',
                                                                    'class'         => 'form-control',
                                                                    'id'            => 'middle_name',
                                                                    'value'         => set_value('middle_name', $worker->middle_name),
                                                                ];
                                                                ?>
                                                                <?= form_input($data); ?>
                                                                <?php echo form_error('middle_name'); ?>
                                                            </div>
                                                        </div><!-- ./ form-group -->
                                                    <?php endif; ?>

                                                    <!-- worker sur_nmae -->
                                                    <div class="form-group">
                                                        <label for="sur_name" class="control-label col-md-5"><?= lang('sur_name') ?></label>
                                                        <div class="col-md-7">
                                                            <?php
                                                            $data = [
                                                                'name'          => 'sur_name',
                                                                'class'         => 'form-control',
                                                                'id'            => 'sur_name',
                                                                'value'         => set_value('sur_name', $worker->sur_name),
                                                            ];
                                                            ?>
                                                            <?= form_input($data); ?>
                                                            <?php echo form_error('sur_name'); ?>
                                                        </div>
                                                    </div><!-- ./ form-group -->

                                                    <!-- DATE OF BIRTH -->
                                                    <div class="form-group">
                                                        <label for="date_of_birth" class="control-label col-md-4"><?= lang('date_of_birth'); ?></label>
                                                        <div class="col-md-8 col-md-push-1">

                                                                <?php
                                                                $date_of_birth = date('d/m/Y', strtotime(str_replace('/', '-', $worker->date_of_birth)));
                                                                ?>

                                                            <input type="text" name="date_of_birth" class="combodate form-control"  data-min-year="<?= date('Y') - 50; ?>" data-format="DD/MM/YYYY" data-template="D MMM YYYY"
                                                                   value="<?= set_value('date_of_birth', $date_of_birth); ?>" data-max-year="<?= date('Y') - 15; ?>">

                                                            <div><?= form_error('date_of_birth') ?></div>

                                                        </div>
                                                    </div>

                                                    <!-- passport number -->
                                                    <div class="form-group">
                                                        <label for="passport_number" class="control-label col-md-5"><?= lang('passport_number') ?></label>
                                                        <div class="col-md-7">
                                                            <?php
                                                            $data = [
                                                                'name' => 'passport_number',
                                                                'class' => 'form-control',
                                                                'id' => 'passport_number',
                                                                'value' => set_value('passport_number', $worker->passport_number)
                                                            ];
                                                            echo form_input($data);
                                                            echo form_error('passport_number');
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <!-- passport Image -->
                                                    <div class="form-group">
                                                        <label for="image" class="col-sm-5 control-label"><?=  lang('passport_image'); ?></label>
                                                        <div class="col-sm-7">
                                                            <input type="file" id="passport_image" name="passport_image" class="form-control">
                                                        </div>
                                                    </div>


                                                    <!-- date of issue -->
                                                    <div class="form-group">
                                                        <label for="date_of_issue" class="control-label col-md-4">
                                                            <?= lang('date_of_issue'); ?>
                                                        </label>
                                                        <div class="col-md-8 col-md-push-1">
                                                            <?php
                                                            $date_of_issue = date('d/m/Y', strtotime(str_replace('/', '-', $worker->date_of_issue)));
                                                            ?>
                                                            <input type="text" name="date_of_issue" class="combodate form-control"  data-min-year="<?= date('Y') - 7; ?>" data-format="DD/MM/YYYY" data-template="D MMMM YYYY"
                                                                   value="<?= set_value('date_of_issue', $date_of_issue); ?>" data-max-year="<?= date('Y'); ?>">
                                                            <div><?= form_error('date_of_issue') ?></div>
                                                        </div>
                                                    </div>


                                                    <?php if ($worker->nationality_id == 11): ?>
                                                    <!-- place of issue -->
                                                    <div class="form-group">
                                                        <label for="place_of_issue" class="control-label col-md-5">Place Of Issue</label>
                                                        <div class="col-md-7">
                                                            <input type="text" name="place_of_issue" value="<?= set_value('place_of_issue', $worker->place_of_issue) ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <!-- date of expiry -->
                                                    <?php
                                                    $date_of_expiry = date('d/m/Y', strtotime(str_replace('/', '-', $worker->date_of_expiry)));
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="date_of_expiry" class="control-label col-md-4">Date Of Expiry</label>
                                                        <div class="col-md-8 col-md-push-1">
                                                            <input type="text" name="date_of_expiry" class="combodate form-control"  data-min-year="<?= date('Y'); ?>" data-format="DD/MM/YYYY" data-template="D MMMM YYYY"
                                                                   value="<?= set_value('date_of_expiry', $date_of_expiry); ?>" data-max-year="<?= date('Y') + 15; ?>">
                                                            <div><?= form_error('date_of_expiry') ?></div>
                                                        </div>
                                                    </div>

                                                    <!-- departure airport -->
                                                    <div class="form-group">
                                                        <label for="departure_airport" class="control-label col-md-5">Departure Airport</label>
                                                        <div class="col-md-7">
                                                            <select name="departure_airport" id="departure_airport" class="form-control">
                                                                <option value="">-- Select --</option>
                                                                <?php foreach ($departure_airports as $airport): ?>
                                                                    <option value="<?= $airport->id; ?>" <?php if ($worker->departure_airport == $airport->id) echo 'selected'; ?>><?= $airport->name_in_english; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <!--                                   </div>-->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- ./ col-md-4 -->


                            <div class="col-md-4">
                                <div class="panel panel-default m-t worker-agent-panel">
                                    <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Worker Skills / Experience</div>
                                    <div class="panel-body">
                                        <div class="tab-content m-t">

                                            <div class="form-horizontal">
                                                <fieldset>

                                                    <div class="form-group">
                                                        <div class="skills-option">
                                                            <div>
                                                                <input type="checkbox" name="english_language" value="1" id="english_language"
                                                                    <?php if ($worker->english_language == '1') echo 'checked'; ?>>
                                                                <label for="english_language">ENGLISH LANGUAGE</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="arabic_language" value="1" id="arabic_language" <?php if ($worker->arabic_language == '1') echo 'checked'; ?>>
                                                                <label for="arabic_language">ARABIC LANGUAGE</label>
                                                            </div>
                                                            <div><input type="checkbox" name="cleaning" value="1" id="cleaning" <?php if ($worker->cleaning == '1') echo 'checked'; ?>>
                                                                <label for="cleaning">CLEANING</label></div>
                                                            <div><input type="checkbox" name="ironing" value="1" id="ironing" <?php if ($worker->ironing == '1') echo 'checked'; ?>>
                                                                <label for="ironing">IRONING</label></div>
                                                            <div><input type="checkbox" name="cooking" value="1" id="cooking" <?php if ($worker->cooking == '1') echo 'checked'; ?>>
                                                                <label for="cooking">COOKING</label></div>
                                                            <div><input type="checkbox" name="baby_sitting" value="1" id="baby_sitting" <?php if ($worker->baby_sitting == '1') echo 'checked'; ?>>
                                                                <label for="baby_sitting">BABY SITTING</label></div>


                                                            <div> <input type="checkbox" name="old_care" value="1" id="old_care" <?php if ($worker->old_care == '1') echo 'checked'; ?>>
                                                                <label for="old_care">OLD CARE</label></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="experience" class="control-label col-md-6">Experience Period</label>
                                                        <div class="col-md-5">
                                                            <input type="text" name="experience_period" id="experience" class="form-control" value="<?= set_value('experience_period', $worker->experience_period); ?>">
                                                        </div>
                                                    </div>

                                                    <!-- experience country -->
                                                    <div class="form-group">
                                                        <label for="experience_country" class="control-label col-md-6">Experience Country
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="text" name="experience_country" id="experience_country" class="form-control" value="<?= set_value('experience_country', $worker->experience_country) ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="memo" class="control-label col-md-6">MEMO</label>
                                                        <div class="col-md-6">
                                                            <textarea name="memo" id="memo" cols="30" rows="10"
                                                                      class="form-control"><?= set_value('memo', $worker->memo); ?></textarea>
                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <!--                                   </div>-->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- ./ col-md-4 -->


                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div><!-- ./ row -->
        <div class="row">
            <div class="col-md-6 col-md-push-3">
                <button type="submit" class="btn btn-primary btn-block"><?= lang('save'); ?></button>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</section>