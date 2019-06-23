<div class="row">
  <div class="col-md-12">
    <div class="box- box-primary">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
              <li class="<?php if (!isset($_SESSION['active_tab'])) echo 'active'; ?>"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><?= lang('general_settings') ?></a></li>
              <li class="<?= active_tab('currencies') ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?= lang('currencies') ?></a></li>
              <li class="<?= active_tab('taxes') ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><?= lang('taxes') ?></a></li>
              <li class="<?= active_tab('logo') ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?= lang('logo') ?></a></li>
              <li class="<?= active_tab('general_content') ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><?= lang('general_content') ?></a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane <?php if (!isset($_SESSION['active_tab'])) echo 'active'; ?>" id="tab_1">
              <?php $this->load->view('_includes/general_settings'); ?>
            </div><!-- ./tab-bane -->
              <div class="tab-pane <?= active_tab('currencies') ?>" id="tab_2">
                    <?php $this->load->view('_includes/currencies'); ?>
              </div>
              <div class="tab-pane <?= active_tab('logo') ?>" id="tab_2">
                  <?php $this->load->view('_includes/logo'); ?>
              </div>

              <div class="tab-pane <?= active_tab('taxes') ?>" id="tab_3">
                    <?php $this->load->view('_includes/taxes'); ?>
              </div>


          </div><!-- ./tab-content -->

        </div><!-- ./nav-tabs-custom -->
    </div>
  </div>
</div>
<?php unset($_SESSION['active_tab']); ?>