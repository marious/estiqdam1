<div class="profile-sidebar">

    <!-- END SIDEBAR USERPIC -->
    <!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
        <h3><?= lang('countries_options'); ?></h3>
    </div>
    <!-- END SIDEBAR USER TITLE -->
    <!-- SIDEBAR BUTTONS -->
    <div class="profile-userbuttons">

    </div>
    <!-- END SIDEBAR BUTTONS -->
    <!-- SIDEBAR MENU -->
    <?php
    $this->load->module('worker_nationality');
    $this->db->order_by('order_in_site');
    $countries = $this->worker_nationality->Worker_nationality_model->get_by(array('show_in_site' => '1'));
    $country_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'country_name_in_english' : 'country_name_in_arabic';
    ?>
    <div class="profile-usermenu">
        <ul class="my-nav">
            <li class="active">
                <a href="<?= site_url(); ?>">
                    <?= lang('all_countries'); ?>
                </a>
            </li>
            <?php foreach ($countries as $country): ?>
            <li>
                <a href="<?= site_url('home/country/' . $country->country_name_in_arabic); ?>">
                    <?= $country->$country_lang; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- END MENU -->
</div>

<div class="profile-sidebar">
    <!-- SIDEBAR USERPIC -->
    <div class="profile-userpic">

    </div>
    <!-- END SIDEBAR USERPIC -->
    <!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
        <h3><?= lang('search_options'); ?></h3>
    </div>
    <!-- END SIDEBAR USER TITLE -->
    <!-- SIDEBAR BUTTONS -->
    <div class="profile-userbuttons">

    </div>
    <!-- END SIDEBAR BUTTONS -->
    <!-- SIDEBAR MENU -->
    <div class="profile-usermenu">
        <form method="GET" action="<?= site_url('home/search'); ?>" accept-charset="UTF-8">
            <ul class="my-nav search-buildings">
                <li>
                    <select name="nationality_id" id="" class="form-control select2-field">
                        <option value=""><?= lang('country'); ?></option>
                        <?php
                        $country_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'country_name_in_english' : 'country_name_in_arabic';
                        foreach ($countries as $country) {
                            echo '<option value="'.$country->id.'">'.$country->$country_lang.'</option>';
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <select class="form-control select2-field" name="job_id">
                        <option value=""><?= lang('job') ?></option>
                        <?php
                        $this->load->module('jobs');
                        $jobs = $this->jobs->Job_model->get();
                        $job_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'name_in_english' : 'name_in_arabic';
                        ?>
                        <?php foreach ($jobs as $job): ?>
                        <option value="<?= $job->id; ?>"><?= $job->$job_lang; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <select class="form-control select2-field" name="religion">
                        <option value=""><?= lang('religion'); ?></option>
                        <?php
                        $this->load->module('religions');
                        $religions = $this->religions->Religion_model->get();
                        $religion_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'religion' : 'arabic_religion';
                        ?>
                        <?php foreach ($religions as $religion): ?>
                        <option value="<?= $religion->id; ?>"><?= $religion->$religion_lang; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <select class="form-control select2-field" name="gender">
                        <option value=""><?= lang('gender'); ?></option>
                        <option value="m"><?= lang('male'); ?></option>
                        <option value="f"><?= lang('female'); ?></option>
                    </select>
                </li>
                <li>
                    <select class="form-control" name="marital_status">
                        <option value=""><?= lang('marital_status'); ?></option>
                        <option value="1"><?= lang('single') ?></option>
                        <option value="2"><?= lang('married') ?></option>
                        <select>
                </li>
                <li>
                    <input class="btn btn-success btn-block" type="submit" value="<?= lang('search'); ?>">
                </li>
            </ul>
        </form>
    </div>
    <!-- END MENU -->
</div>