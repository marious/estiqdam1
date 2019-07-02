<div class="row">
  <div class="col-md-12">
    <div class="box- box-primary">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
              <li class="<?php if (!isset($_SESSION['active_tab'])) echo 'active'; ?>"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><?= lang('global_settings') ?></a></li>
              <li class="<?= active_tab('logo') ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?= lang('logo') ?></a></li>
              <li class="<?= active_tab('general_content') ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><?= lang('general_content') ?></a></li>
              <li class="<?= active_tab('social_media') ?>"><a href="#tab_4" data-toggle="tab" aria-expanded="false"><?= lang('social_media') ?></a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane <?php if (!isset($_SESSION['active_tab'])) echo 'active'; ?>" id="tab_1">
              <?php $this->load->view('_includes/global_settings'); ?>
            </div><!-- ./tab-bane -->
              <div class="tab-pane <?= active_tab('logo') ?>" id="tab_2">
                    <?php $this->load->view('_includes/logo'); ?>
              </div>

              <div class="tab-pane <?= active_tab('general_content') ?>" id="tab_3">
                    <?php $this->load->view('_includes/general_content'); ?>
              </div>

              <div class="tab-pane <?= active_tab('social_media') ?>" id="tab_4">
                    <?php $this->load->view('_includes/social_media'); ?>
              </div>
          </div><!-- ./tab-content -->

        </div><!-- ./nav-tabs-custom -->
    </div>
  </div>
</div>
<?php unset($_SESSION['active_tab']); ?>