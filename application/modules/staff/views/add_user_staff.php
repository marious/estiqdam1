<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Staff / Add  New Staff</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'staff'; ?>">Staff</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Staff</div>
                            <div class="panel-body">
                                <div class="m-t">
                                    <ul class="users-types-tabs" id="users-types-tabs">
                                        <li><a class="active" href="<?= site_url('staff/add_user_staff'); ?>">User Staff</a></li>
                                        <li><a href="<?= site_url('staff/add_user_customer'); ?>">User Customer</a></li>
                                        <li><a  href="<?= site_url('staff/add_user_agent') ?>">User Agent</a></li>
                                    </ul>

                                    <br>

                                    <div class="tab-content users-form">
                                        <?php include 'includes/user_staff.php'; ?>
                                    </div>

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