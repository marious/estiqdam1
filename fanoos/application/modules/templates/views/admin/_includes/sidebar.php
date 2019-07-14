<section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= site_url('assets/admin/img/user.png') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['username'] ? ucwords($_SESSION['username']) : ''; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

          <?php if (in_array('show_users', $logged_in_user_permissions)): ?>
          <li class="treeview <?= is_sidebar_menu_active('customers') ?>">
              <a href="#"><i class="fa fa-users text-green"></i> <span><?= lang('customers') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('customers', 'all'); ?>"><a href="<?= site_url('customers/all'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_customers'); ?></a></li>
                  <?php if (in_array('add_customers', $logged_in_user_permissions)): ?>
                      <li class="<?= is_tree_sidebar_menu_active('customers', 'add'); ?>"><a href="<?= site_url('customers/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_new'); ?></a></li>
                  <?php endif; ?>

              </ul>
          </li>
          <?php endif; ?>

          <li class="treeview <?= is_sidebar_menu_active('items') ?>">
              <a href="#"><i class="fa fa-cubes text-orange"></i> <span><?= lang('products_and_services') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('items', 'products'); ?>"><a href="<?= site_url('items/products'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_products'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'add_product'); ?>"><a href="<?= site_url('items/add_product'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_product'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'services'); ?>"><a href="<?= site_url('items/services'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_services'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'add_service'); ?>"><a href="<?= site_url('items/add_service'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_service'); ?></a></li>
              </ul>
          </li>




          <li class="treeview <?= is_sidebar_menu_active('banks') ?>">
              <a href="#"><i class="fa fa-bank"></i> <span><?= lang('banks') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('banks', 'all'); ?>"><a href="<?= site_url('banks/all'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_banks'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('banks', 'add_product'); ?>"><a href="<?= site_url('banks/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_bank'); ?></a></li>
              </ul>
          </li>


          <li class="treeview <?= is_sidebar_menu_active('transactions') ?>">
              <a href="#"><i class="fa fa-dashboard"></i> <span><?= lang('transactions') ?></span>
                  <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('transactions', 'all'); ?>"><a href="<?= site_url('transactions/all'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_transactions'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('transactions', 'deposit'); ?>"><a href="<?= site_url('transactions/deposit'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_income'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('transactions', 'expense'); ?>"><a href="<?= site_url('transactions/expense'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_expense'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('transactions', 'transfer'); ?>"><a href="<?= site_url('transactions/transfer'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_transfer'); ?></a></li>
              </ul>
          </li>


      <?php if (in_array('show_users', $logged_in_user_permissions)): ?>
          <li class="treeview <?= is_sidebar_menu_active('users'); ?>">
              <a href="#"><i class="fa fa-user text-yellow"></i> <span><?= lang('users') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
            <ul class="treeview-menu">
                <li class="<?= is_tree_sidebar_menu_active('users', 'all'); ?>"><a href="<?= site_url('users/all'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_users'); ?></a></li>
<?php if (in_array('add_users', $logged_in_user_permissions)): ?>
                <li class="<?= is_tree_sidebar_menu_active('users', 'add'); ?>"><a href="<?= site_url('users/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_new'); ?></a></li>
<?php endif; ?>
            </ul>
          </li>
<?php endif; ?>



          <li class="treeview <?= is_sidebar_menu_active('roles'); ?>">
              <a href="#"><i class="fa fa-key text-red"></i> <span><?= lang('roles_and_permissions') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('roles', 'all'); ?>"><a href="<?= site_url('roles/all'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_roles'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('roles', 'add'); ?>"><a href="<?= site_url('roles/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_new'); ?></a></li>
              </ul>
          </li>




          <li class="treeview <?= is_sidebar_menu_active('settings'); ?>">
              <a href="#"><i class="fa fa-gear"></i> <span><?= lang('settings') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('settings', 'main'); ?>"><a href="<?= site_url('settings'); ?>"><i class="fa fa-circle-o"></i> <?= lang('main_settings'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('settings', 'expense_categories'); ?>"><a href="<?= site_url('settings/expense_categories'); ?>"><i class="fa fa-circle-o"></i> <?= lang('expense_categories'); ?></a></li>
              </ul>
          </li>
        
      </ul>
    </section>