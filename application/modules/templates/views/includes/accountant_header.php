<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>/theme/images/favicon.png">
    <title>Peace4r Accountant System</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url() ?>/theme/css/bootstrap.css" rel="stylesheet">


    <link href="<?php echo base_url() ?>/theme/css/metisMenu.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/ionicons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/c3.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/select2.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/theme/css/responsive.dataTables.css">
    <link href="<?php echo base_url() ?>/theme/css/slicknav.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/sweetalert.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>/theme/css/material.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/ripples.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/theme/css/roboto.css" rel="stylesheet">


    <?php if ($_SESSION['language'] == 'arabic'): ?>
                <link rel="stylesheet" href="https://cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <?php endif; ?>


    <link href="<?php echo base_url(). '/theme/css/my-style.css?v=' . filemtime(FCPATH . 'theme/css/my-style.css'); ?>" rel="stylesheet">




    <!--jquery-->
    <script src="<?php echo base_url() ?>/theme/js/jquery.js"></script>
    <script src='<?php echo base_url() ?>/theme/js/modernizr.js'></script>



</head>
<body>
<div class="block-ui">
    <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
</div>
<?php
$wrapper_style = $_SESSION['language'] == 'arabic' ? 'padding-right: 250px;' : 'padding-left: 250px;';
?>
<div id="wrapper" style="<?= $wrapper_style; ?>">
    <div class="row">
        <header>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 headerbar">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 left-headerbar">
                    <ul class="leftheader-menu">
                        <li><a href="">Peace4r Accountant System</a></li>
                        <li class="hide-class"><a class="hide-nav" href=""><i class="fa fa-bars"></i></a></li>
                    </ul>
                </div>
                <!-- End left header-->

                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 right-headerbar">
                    <?php
                    $header_style = $_SESSION['language'] == 'arabic'  ? "left: 0;" : "right: 0;";
//                    $header_style = '';
                    ?>
                    <div class="rightheader-menu" style="<?= $header_style; ?>">

                        <div class="header-nav-profile">
                            <a id="profile" href=""><img src="<?php echo base_url() ?>/theme/images/avatar.jpg" alt="" />
                                <span class="profile-info"><?php echo $this->session->userdata('username'); ?>
                                    <?php if ($this->session->userdata('user_type')=='Admin'){ ?>
                                        <small>Administrator</small>
                                    <?php }else{ ?>
                                        <small><?php echo $this->session->userdata('user_type'); ?></small>
                                    <?php } ?>

</span><span class="caret"></span>
                            </a>
                            <ul class="dropdown-profile">
                                <li><a href="<?php echo site_url('site_security/logout') ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;<?= lang('logout'); ?></a></li>
                                <?php
                                $lang_link = $_SESSION['language'] == 'arabic' ? '<a href="'.site_url('site_settings/lang/english').'">'.lang('english').'</a>'
                                : '<a href="'.site_url('site_settings/lang/arabic').'">'.lang('arabic').'</a>';
                                ?>
                                <li><?= $lang_link; ?></li>
                            </ul>
                        </div>
                        <!--End Header-nav-provile -->
                    </div>
                </div>
                <!-- End Right header-->

                <!-- End Header-->
                <!--Start Sidebar-->
            </div>
        </header>


        <!-- Profile Modal -->
        <div id="profileModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Profile</h4>
                    </div>
                    <div class="modal-body">

                        <!--Start Panel-->
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Edit Profile</div>
                            <div class="panel-body add-client">
                                <form id="edit-profile" method="post" action="<?php echo site_url('Admin/updateProfile') ?>">
                                    <div class="form-group">
                                        <label for="profle-username">Username</label>
                                        <input type="text" value="<?php echo $this->session->userdata('username') ?>"
                                               class="form-control" name="username" id="profle-username">
                                    </div>
                                    <div class="form-group">
                                        <label for="profle-fullname">Fullname</label>
                                        <input type="text" value="<?php echo $this->session->userdata('fullname') ?>"
                                               class="form-control" name="fullname" id="profle-fullname">
                                    </div>
                                    <div class="form-group">
                                        <label for="profle-email">Email</label>
                                        <input type="text" value="<?php echo $this->session->userdata('email') ?>"
                                               class="form-control" name="email" id="profle-email">
                                    </div>

                                    <button type="submit"  class="mybtn btn-submit"><i class="fa fa-check"></i> Update</button>
                                </form>
                            </div>
                            <!--End Panel Body-->
                        </div>
                        <!--End Panel-->
                    </div>

                </div>
            </div>
        </div>
        <!--End Model-->


        <!-- Modal -->
        <div id="passwordModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">

                        <!--Start Panel-->
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Change Password</div>
                            <div class="panel-body add-client">
                                <form id="change-password" method="post" action="<?php echo site_url('Admin/changePassword') ?>">
                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input type="password"
                                               class="form-control" name="new-password" id="new-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confrim-change">Confrim Password</label>
                                        <input type="password"
                                               class="form-control" name="confrim-password" id="confrim-password">
                                    </div>


                                    <button type="submit"  class="mybtn btn-submit"><i class="fa fa-check"></i> Update</button>
                                </form>
                            </div>
                            <!--End Panel Body-->
                        </div>
                        <!--End Panel-->
                    </div>

                </div>
            </div>
        </div>
        <!--End Model-->

        <!-- Calculator Model -->
        <!-- Modal -->
        <div id="calculatorModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Calculator</h4>
                    </div>
                    <div class="modal-body">

                        <div class="calculator">
                            <input type="text" readonly>
                            <div class="row">
                                <div class="key">1</div>
                                <div class="key">2</div>
                                <div class="key">3</div>
                                <div class="key last">0</div>
                            </div>
                            <div class="row">
                                <div class="key">4</div>
                                <div class="key">5</div>
                                <div class="key">6</div>
                                <div class="key last action instant">cl</div>
                            </div>
                            <div class="row">
                                <div class="key">7</div>
                                <div class="key">8</div>
                                <div class="key">9</div>
                                <div class="key last action instant">=</div>
                            </div>
                            <div class="row">
                                <div class="key action">+</div>
                                <div class="key action">-</div>
                                <div class="key action">x</div>
                                <div class="key last action">/</div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--End Calculator Model-->

        <!-- Calendar Model -->
        <!-- Modal -->
        <div id="calendarModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Calendar</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Create Calendar-->
                        <div id="current-calendar"></div>

                    </div>

                </div>
            </div>
        </div>
        <!--End Calendar Model-->


        <section>
            <div class="content-area">
                <aside>
                    <?php
                    $language = $_SESSION['language'];
                    $class_sidebar = 'left-sidebar';
                    if ($language == 'arabic') {$class_sidebar = 'right-sidebar';};
                    ?>
                    <div class="sidebar <?= $class_sidebar; ?>">

                        <ul id="menu" class="menu-helper asyn-menu">
                            <li><a class="active-menu" href="<?php echo site_url('acc_admin/dashboard') ?>"><i  class="fa fa-tachometer"></i>
                                    <span class="title"><?= lang('dashboard'); ?></span></a></li>

<!--                            <li class="has-sub">-->
<!--                                <a href="#"><i class="fa fa-suitcase"></i>-->
<!--                                    <span class="title">Widgets</span></a>-->
<!--                                <ul class="collapse">-->
<!--                                    <li><a href="#" data-toggle="modal" data-target="#calculatorModal"><i class="fa fa-calculator"></i> Calculator</a></li>-->
<!--                                    <li><a href="#" data-toggle="modal" data-target="#calendarModal"><i class="fa fa-calendar"></i> Calendar</a></li>-->
<!--                                </ul>-->

                                <?php if ($_SESSION['permission_role'] == 'admin'): ?>
                            <li class="has-sub">
                                <a href="#"><i class="fa fa-university"></i>
                                    <span class="title"><?= lang('accounts'); ?></span></a>
                                <ul class="collapse">
                                    <li><a href="<?php echo site_url('acc_admin/manageAccount') ?>"><i class="fa fa-table"></i> <?= lang('manage_accounts'); ?></a></li>
                                    <li><a href="<?php echo site_url('acc_admin/addAccount') ?>"><i class="fa fa-user-plus"></i> <?= lang('add_account'); ?></a></li>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <li class="has-sub">
                                <a href="#"><i class="fa fa-money"></i>
                                    <span class="title"><?= lang('transactions'); ?></span></a>
                                <ul class="collapse">
                                    <?php if ($_SESSION['permission_role'] == 'admin'): ?>
                                        <li><a class="asyn-income" href="<?php echo site_url('acc_admin/addIncome') ?>"><i class="fa fa-plus-square"></i> <?= lang('add_income'); ?></a></li>
                                    <?php endif; ?>
                                    <li><a class="asyn-expense" href="<?php echo site_url('acc_admin/addExpense') ?>"><i class="fa fa-minus-square"></i> <?= lang('add_expense'); ?></a></li>
                                    <?php if ($_SESSION['permission_role'] == 'admin'): ?>
                                        <li><a href="<?php echo site_url('acc_admin/transfer') ?>"><i class="fa fa-retweet"></i> <?= lang('transfer'); ?></a></li>
                                        <li><a href="<?php echo site_url('acc_admin/manageIncome') ?>"><i class="fa fa-calculator"></i> <?= lang('manage_income'); ?></a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo site_url('acc_admin/manageExpense') ?>"><i class="fa fa-calculator"></i> <?= lang('manage_expense'); ?></a></li>

                                </ul>
                            </li>

                            <!--                            <li class="has-sub">-->
                            <!--                                <a href="#"><i class="fa fa-repeat"></i>-->
                            <!--                                    <span class="title">Recurring Transaction</span></a>-->
                            <!--                                <ul class="collapse">-->
                            <!--                                    <li><a class="asyn-repeat-income" href="--><?php //echo site_url('acc_admin/repeatIncome') ?><!--"><i class="fa fa-plus-circle"></i> Repeating Income</a></li>-->
                            <!--                                    <li><a class="asyn-repeat-expense" href="--><?php //echo site_url('acc_admin/repeatExpense') ?><!--"><i class="fa fa-minus-circle"></i> Repeating Expense</a></li>-->
                            <!--                                    <li><a href="--><?php //echo site_url('acc_admin/processIncome') ?><!--"><i class="fa fa-calendar-plus-o"></i> Manage Repeating Income</a></li>-->
                            <!--                                    <li><a href="--><?php //echo site_url('acc_admin/processExpense') ?><!--"><i class="fa fa-calendar-minus-o"></i> Manage Repeating Expense</a></li>-->
                            <!--                                    <li><a href="--><?php //echo site_url('acc_admin/incomeCalender') ?><!--"><i class="fa fa-calendar"></i> Income Calendar</a></li>-->
                            <!--                                    <li><a href="--><?php //echo site_url('acc_admin/expenseCalender') ?><!--"><i class="fa fa-calendar"></i> Expense Calendar</a></li>-->
                            <!--                                </ul>-->
                            <!--                            </li>-->


                            <li class="has-sub">
                                <a href="#"><i class="fa fa-area-chart"></i>
                                    <span class="title"><?= lang('reporting'); ?></span></a>
                                <ul class="collapse">
                                    <li><a href="<?php echo site_url('acc_reports/accountsReport') ?>"><i class="fa fa-angle-double-right"></i> <?= lang('account_report'); ?></a></li>
                                    <?php if ($_SESSION['permission_role'] == 'admin'): ?>
                                        <li><a href="<?php echo site_url('acc_reports/datewiseIncomeReport') ?>"><i class="fa fa-angle-double-right"></i> <?= lang('income_report_by_date'); ?></a></li>
                                    <?php endif; ?>
                                    <!--                                    <li><a href="--><?php //echo site_url('Reports/daywiseIncomeReport') ?><!--"><i class="fa fa-angle-double-right"></i> Day Wise Income Report</a></li>-->
                                    <li><a href="<?php echo site_url('acc_reports/datewiseExpenseReport') ?>"><i class="fa fa-angle-double-right"></i> <?= lang('expense_report_by_date'); ?></a></li>
                                    <!--                                    <li><a href="--><?php //echo site_url('Reports/daywiseExpenseReport') ?><!--"><i class="fa fa-angle-double-right"></i> Day Wise Expense Report</a></li>-->
                                    <!--                                    <li><a href="--><?php //echo site_url('Reports/transferReport') ?><!--"><i class="fa fa-angle-double-right"></i> Transfer Report</a></li>-->
                                    <?php if ($_SESSION['permission_role'] == 'admin'): ?>
                                        <li><a href="<?php echo site_url('acc_reports/incomeVsExpense') ?>"><i class="fa fa-angle-double-right"></i> <?= lang('income_vs_expense_report'); ?></a></li>
                                        <!--                                    <li><a href="--><?php //echo site_url('Reports/incomeCategoryReport') ?><!--"><i class="fa fa-angle-double-right"></i> Report By Chart Of Accounts</a></li>-->
<!--                                        <li><a href="--><?php //echo site_url('acc_reports/reportByPayer') ?><!--"><i class="fa fa-angle-double-right"></i> Report By Payer</a></li>-->
                                        <li><a href="<?php echo site_url('acc_reports/reportByPayee') ?>"><i class="fa fa-angle-double-right"></i> <?= lang('report_by_payee'); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>

                            <?php if ($_SESSION['permission_role'] == 'admin'): ?>
                                <li class="has-sub">
                                    <a href="#"><i class="fa fa-credit-card"></i>
                                        <span class="title">Transaction Settings</span></a>
                                    <ul class="collapse">
                                        <li><a href="<?php echo site_url('acc_admin/chartOfAccounts') ?>"><i class="fa fa-book"></i> Chart Of Accounts</a></li>
                                        <li><a href="<?php echo site_url('acc_admin/payeeAndPayers') ?>"><i class="fa fa-exchange"></i> Payees and payers</a></li>
                                        <li><a href="<?php echo site_url('acc_admin/paymentMethod') ?>"><i class="fa fa-credit-card"></i> Payment Methods</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if ($_SESSION['permission_role'] == 'admin'): ?>
                                <li class="has-sub">
                                    <a href="#"><i class="fa fa-cog"></i>
                                        <span class="title">Administration</span></a>
                                    <ul class="collapse">
                                        <li><a href="<?php echo site_url('acc_admin/userManagement') ?>"><i class="fa fa-users"></i> User Management</a></li>
                                        <!--<li><a href="<?php echo site_url('acc_admin/addLanguage') ?>"><i class="fa fa-language"></i>Add Language</a></li>-->
                                        <li><a href="<?php echo site_url('acc_admin/generalSettings') ?>"><i class="fa fa-cogs"></i> General Settings</a></li>
                                        <li><a href="<?php echo site_url('acc_admin/backupDatabase') ?>"><i class="fa fa-database"></i> Backup Database</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </aside>
                <!--Javascript Code -->
                <script type="text/Javascript">

                </script>



                <!--End Sidebar-->
                <div class="asyn-div">