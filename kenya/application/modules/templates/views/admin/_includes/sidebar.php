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
              <a href="#"><i class="fa fa-users text-green"></i> <span><?= lang('customers') ?> & <?=  lang('vendors') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('customers', 'all_customers'); ?>"><a href="<?= site_url('customers/all_customers'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_customers'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('customers', 'all_vendors'); ?>"><a href="<?= site_url('customers/all_vendors'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_vendors'); ?></a></li>


              </ul>
          </li>
          <?php endif; ?>


          <li class="treeview <?= is_sidebar_menu_active('sales') ?>">
              <a href="#"><i class="fa fa-cart-plus text-red"></i> <span><?= lang('sales') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <?php if (in_array('create_invoice', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('sales', 'invoice'); ?>"><a href="<?= site_url('sales/invoice'); ?>"><i class="fa fa-circle-o"></i> <?= lang('create_invoice'); ?></a></li>
                  <?php endif; ?>
                  <?php if (in_array('show_invoices', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('sales', 'all_invoices'); ?>"><a href="<?= site_url('sales/all_invoices'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_invoices'); ?></a></li>
                  <?php endif; ?>
              </ul>
          </li>


          <?php if (!KENYA): ?>
          <li class="treeview <?= is_sidebar_menu_active('purchase') ?>">
              <a href="#"><i class="fa fa-opencart text-blue"></i> <span><?= lang('purchase') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('purchase', 'new_purchase'); ?>"><a href="<?= site_url('purchase/new_purchase'); ?>"><i class="fa fa-circle-o"></i> <?= lang('new_purchase'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('purchase', 'purchase_list'); ?>"><a href="<?= site_url('purchase/purchase_list'); ?>"><i class="fa fa-circle-o"></i> <?= lang('purchase_list'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('purchase', 'received_product_list'); ?>"><a href="<?= site_url('purchase/received_product_list'); ?>"><i class="fa fa-circle-o"></i> <?= lang('received_product'); ?></a></li>
              </ul>
          </li>
        <?php endif; ?>


          <li class="treeview <?= is_sidebar_menu_active('items') ?>">
              <a href="#"><i class="fa fa-cubes text-orange"></i> <span><?= lang('services') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <?php if (!KENYA): ?>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'products'); ?>"><a href="<?= site_url('items/products'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_products'); ?></a></li>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'add_product'); ?>"><a href="<?= site_url('items/add_product'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_product'); ?></a></li>
                <?php endif; ?>
                  <?php if (in_array('show_services', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'services'); ?>"><a href="<?= site_url('items/services'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_services'); ?></a></li>
                  <?php endif; ?>
                  <?php if (in_array('add_service', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'add_service'); ?>"><a href="<?= site_url('items/add_service'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_service'); ?></a></li>
                  <?php endif; ?>
                  <?php if (in_array('show_categories', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('items', 'categories'); ?>"><a href="<?= site_url('items/categories'); ?>"><i class="fa fa-circle-o"></i> <?= lang('categories'); ?></a></li>
                  <?php endif; ?>
              </ul>
          </li>


          <li class="treeview <?= is_sidebar_menu_active('accounts') ?>">
              <a href="#"><i class="fa fa-dollar"></i> <span><?= lang('accounts') ?></span>
                  <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
              <ul class="treeview-menu">
                  <?php if (in_array('show_accounts', $logged_in_user_permissions)): ?>
                      <li class="<?= is_tree_sidebar_menu_active('accounts', 'chart_of_account'); ?>"><a href="<?= site_url('accounts/chart_of_account'); ?>"><i class="fa fa-circle-o"></i> <?= lang('accounts'); ?></a></li>
                  <?php endif; ?>
              </ul>
          </li>



          <li class="treeview <?= is_sidebar_menu_active('transactions') ?>">
              <a href="#"><i class="fa fa-dashboard"></i> <span><?= lang('transactions') ?></span>
                  <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
              <ul class="treeview-menu">
                  <?php if (in_array('show_transactions', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('transactions', 'all_transaction'); ?>"><a href="<?= site_url('transactions/all_transaction'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_transactions'); ?></a></li>
                  <?php endif; ?>

                  <?php if (in_array('add_income', $logged_in_user_permissions)): ?>
                  <li><a href="<?= site_url('transactions/add_transaction?type=income') ?>"><i class="fa fa-circle-o"></i><?= lang('add_income') ?></a></li>
                  <?php endif; ?>


                  <?php if (in_array('add_expense', $logged_in_user_permissions)): ?>
                  <li><a href="<?= site_url('transactions/add_transaction?type=expense') ?>"><i class="fa fa-circle-o"></i><?= lang('add_expense') ?></a></li>
                  <?php endif; ?>

                  <?php if (in_array('add_transfer', $logged_in_user_permissions)): ?>
                  <li><a href="<?= site_url('transactions/add_transaction?type=transfer') ?>"><i class="fa fa-circle-o"></i><?= lang('add_transfer') ?></a></li>
                  <?php endif; ?>

                  <?php if (in_array('income_categories', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('transactions', 'income_category'); ?>"><a href="<?= site_url('transactions/income_category'); ?>"><i class="fa fa-circle-o"></i> <?= lang('income_categories'); ?></a></li>
                  <?php endif; ?>

                  <?php if (in_array('expense_categories', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('transactions', 'expense_category'); ?>"><a href="<?= site_url('transactions/expense_category'); ?>"><i class="fa fa-circle-o"></i> <?= lang('expense_categories'); ?></a></li>
                  <?php endif; ?>
              </ul>
          </li>


          <?php if (in_array('show_reports', $logged_in_user_permissions)): ?>
          <li <?= is_sidebar_menu_active('reports'); ?>>
              <a href="<?= site_url('reports') ?>"><i class="fa fa-file"></i> <span><?= lang('reports') ?></span>
              </a>
          </li>
        <?php endif; ?>

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




          <?php if (in_array('show_roles', $logged_in_user_permissions)): ?>
          <li class="treeview <?= is_sidebar_menu_active('roles'); ?>">
              <a href="#"><i class="fa fa-key text-red"></i> <span><?= lang('roles_and_permissions') ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= is_tree_sidebar_menu_active('roles', 'all'); ?>"><a href="<?= site_url('roles/all'); ?>"><i class="fa fa-circle-o"></i> <?= lang('all_roles'); ?></a></li>
                  <?php if (in_array('add_roles', $logged_in_user_permissions)): ?>
                  <li class="<?= is_tree_sidebar_menu_active('roles', 'add'); ?>"><a href="<?= site_url('roles/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_new'); ?></a></li>
                  <?php endif; ?>
              </ul>
          </li>
          <?php endif; ?>




          <li class="<?= is_sidebar_menu_active('settings'); ?>">
              <a href="<?= site_url('settings') ?>"><i class="fa fa-gear"></i> <span><?= lang('settings') ?></span>
              </a>
          </li>
        
      </ul>
    </section>