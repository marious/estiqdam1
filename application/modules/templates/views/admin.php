<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peace For Recruitment</title>
    <link rel="stylesheet" href="<?= admin_assets('css/bootstrap.min.css') ?>">
    <?php if (isset($datepicker) && ($datepicker == true)): ?>
        <link rel="stylesheet" href="<?= admin_assets('css/bootstrap-datetimepicker.min.css') ?>">
    <?php endif; ?>
    <?php if (isset($datatables)): ?>
        <link rel="stylesheet" href="<?= admin_assets('css/dataTables.bootstrap.min.css') ?>">
    <?php endif; ?>
    <?php if (isset($_SESSION['language']) && $_SESSION['language'] == 'arabic'): ?>
        <link rel="stylesheet" href="<?= site_url('assets/css/bootstrap-arabic.css') ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo admin_assets('css/style.css') . '?v=' . filemtime(FCPATH . 'assets/admin_panel/css/style.css');   ?>">
    <?php if (isset($datepicker_range)): ?>
        <link rel="stylesheet" href="<?= admin_assets('css/daterangepicker.css') ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= site_url('assets/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <?php if (isset($css_files)): ?>
        <?php foreach ($css_files as $css_file): ?>
            <link rel="stylesheet" href="<?= site_url($css_file); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($_SESSION['language'] == 'english'): ?>
        <style>
            .entry-form label {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .entry-form label {
                text-align: right !important;
            }
            .users-form label,
            .worker-entry label {
                text-align: left !important;;
            }

        </style>
    <?php endif; ?>
    <?php if ($_SESSION['language'] == 'arabic'): ?>
        <style>
            .btn-group .dropdown-menu {
                left: 0 !important;;
                right: auto !important;
            }
        </style>
    <?php elseif ($_SESSION['language'] == 'english'): ?>
        <style>
            .btn-group .dropdown-menu {
                right: 0 !important;
                left: auto; !important;
            }
        </style>

    <?php endif; ?>

</head>
<body>

<?php
if (isset($_SESSION['language']) && $_SESSION['language'] == 'arabic') {
    $dir = 'left';
} else {
    $dir = 'right';
}
$caret = '<span class="caret"></span> ';
?>

<div class="navbar navbar-default">
    <div class="fluid-container">
        <div class="navbar-header">
            <a href="<?= site_url('services_entry/all_contracts'); ?>" class="navbar-brand"><?= lang('prog_name'); ?></a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <?php if (isset($_SESSION['access_id']) && $_SESSION['access_id'] == 4):  ?>
                    <li><a href="<?= site_url('agent_worker'); ?>">Workers</a></li>
                    <li><a href="<?= site_url('agent_worker/underprocessing'); ?>">Under Processing Workers</a></li>
                    <li><a href="<?= site_url('agent_worker/accepted'); ?>">Selected Workers</a></li>
                    <li><a href="<?= site_url('agent_worker/reports_arrived') ?>">Arrived Workers</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php if ($dir == 'left') echo $caret; ?>  <?= lang('reports') ?> <?php if ($dir != 'left') echo $caret; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= site_url('agent_worker/reports_not_stamp'); ?>">Not Stamp Report</a></li>
                            <li><a href="<?= site_url('agent_worker/reports_not_arrived'); ?>">Not Arrived Report</a></li>
                            <li><a href="<?= site_url('agent_worker/reports_arrived'); ?>">Arrived Report</a></li>
                            <li><a href="<?= site_url('agent_worker/payment_report'); ?>">Payment Report</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= site_url('agent_worker/tickets'); ?>">Tickets</a></li>
                <?php else: ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php if ($dir == 'left') echo $caret; ?>  <?= lang('settings') ?> <?php if ($dir != 'left') echo $caret; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('site_settings') ?>"><?= lang('site_settings'); ?></a></li>
<!--                        <li><a href="--><?//= base_url('site_settings/tax'); ?><!--">--><?//= lang('tax_amount'); ?><!--</a></li>-->
                        <li><a href="<?= base_url('staff') ?>"><?= lang('staff'); ?></a></li>
                        <li><a href="<?= base_url('agents'); ?>"><?= lang('agents') ?></a></li>
<!--                        <li><a href="--><?//= base_url('customers') ?><!--">--><?//= lang('customers'); ?><!--</a></li>-->
                        <li><a href="<?= base_url('arrival_airports') ?>"><?= lang('arrival_airports'); ?></a></li>
                        <li>
                            <a href="<?= base_url('departure_airports'); ?>">
                                <?= lang('departure_airports'); ?>
                            </a>
                        </li>
                        <li><a href="<?= base_url('worker_nationality') ?>"><?= lang('worker_nationality'); ?></a></li>
                        <li><a href="<?= base_url('customer_nationality') ?>"><?= lang('customer_nationality'); ?></a></li>
                        <li><a href="<?= base_url('representatives') ?>"><?= lang('representatives'); ?></a></li>
                        <li><a href="<?= base_url('jobs') ?>"><?= lang('jobs'); ?></a></li>
                        <li><a href="<?= base_url('order_types') ?>"><?= lang('order_types'); ?></a></li>
<!--                        <li><a href="--><?//= base_url('credit_card') ?><!--">--><?//= lang('credit_card'); ?><!--</a></li>-->
                        <li><a href="<?= base_url('visa_issued_city') ?>"><?= lang('visa_issued_city'); ?></a></li>
                        <li><a href="<?= base_url('style_settings') ?>"><?= lang('style_settings'); ?></a></li>
<!--                        <li><a href="--><?//= site_url('site_admin/contact_messages'); ?><!--">--><?//= lang('contact_messages'); ?><!--</a></li>-->
<!--                        <li><a href="--><?//= site_url('seo_pages'); ?><!--">SEO Pages</a></li>-->
<!--                        <li><a href="--><?//= site_url('tanazul'); ?><!--">Tanazul Control</a></li>-->
                    </ul>
                </li>

                <li>
                    <a href="<?= site_url('services_entry'); ?>" class="dropdown-toggle"><?= lang('services'); ?></a>
                </li>
                    <li><a href="<?= base_url('customers') ?>"><?= lang('customers'); ?></a></li>
                 <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <?php if ($dir == 'left') echo $caret; ?>  <?= lang('agent_workers') ?> <?php if ($dir != 'left') echo $caret; ?>
                     </a>
                     <ul class="dropdown-menu">
                         <li><a href="<?= site_url('agent_worker/workers'); ?>"><?= lang('all_workers'); ?></a></li>
                         <li><a href="<?= site_url('agent_worker/accepted_workers'); ?>"><?= lang('accepted_workers'); ?></a></li>
                         <li><a href="<?= site_url('agent_worker/vfs'); ?>"><?= lang('vfs_workers'); ?></a></li>
                         <li><a href="<?= site_url('agent_worker/new_workers'); ?>"><?= lang('new_workers'); ?></a></li>
                         <li><a href="<?= site_url('agent_worker/refuse_workers'); ?>"><?= lang('refuse_workers'); ?></a></li>
                         <li><a href="<?= site_url('agent_worker/worker_documents'); ?>"><?= lang('worker_documents'); ?></a></li>
                         <li><a href="<?= site_url('agent_worker/add_worker') ?>"><?= lang('add_worker'); ?></a></li>
                     </ul>
                 </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php if ($dir == 'left') echo $caret; ?>  <?= lang('reports') ?> <?php if ($dir != 'left') echo $caret; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= site_url('reports/not_stamp'); ?>"><?= lang('not_stamp_report') ?></a></li>
                            <li><a href="<?= site_url('reports/not_arrived'); ?>"><?= lang('not_arrived_report'); ?></a></li>
                            <li><a href="<?= site_url('reports/arrived'); ?>"><?= lang('arrived_report'); ?></a></li>
                            <li><a href="<?= site_url('reports/not_paid') ?>"><?= lang('customers_not_paid_remains_report'); ?></a></li>
                            <li><a href="<?= site_url('reports/operation_reports'); ?>"><?= lang('operations_reports'); ?></a></li>
                            <?php if(isset($_SESSION['permission_role']) && $_SESSION['permission_role'] == 'admin'): ?>
                            <li><a href="<?= site_url('reports/chart_reports'); ?>">Chart Reports</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if ($dir == 'left') echo $caret; ?>  <?= lang('finance_operations') ?> <?php if ($dir != 'left') echo $caret; ?>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= site_url('finance/prepaid_customer_payment'); ?>"><?= lang('prepaid_customer_payment'); ?></a>
                                </li>
                                <li><a href="<?= site_url('finance/customers_payment'); ?>">
                                        <?= lang('customers_payment'); ?>
                                    </a>
                                </li>
                                <?php if(isset($_SESSION['permission_role']) && $_SESSION['permission_role'] == 'admin'): ?>
                                    <li><a href="<?= site_url('reports/financial_reports'); ?>"><?= lang('financial_reports'); ?></a></li>
                                    <li><a href="<?= site_url('reports/advanced_reports'); ?>"><?= lang('financial_reports_rapid'); ?></a></li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?= site_url('finance/agents_payment') ?>"><?= lang('agents_payment'); ?></a>
                                </li>
                                <li>
                                    <a href="<?= site_url('transfer_types'); ?>"><?= lang('transfer_types') ?></a>
                                </li>
                                <li>
                                    <a href="<?= site_url('acc_admin') ?>"><?= lang('accountant'); ?></a>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li><a href="<?= site_url('services_entry/processing_list') ?>"><?= lang('processing'); ?></a></li>
                    <li><a href="<?= site_url('tickets') ?>"><?= lang('tickets'); ?></a></li>
            <?php endif; ?>
            </ul>

            <ul class="nav navbar-nav navbar-<?= $dir; ?>">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if ($dir == 'left') {echo $caret;} ?>
                        <span class="glyphicon glyphicon-user"></span> <?= $_SESSION['username'] ?> <?php if ($dir != 'left') {echo $caret;} ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('site_security/logout'); ?>"><?= lang('logout'); ?></a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if ($dir == 'left') {
                            echo $caret;
                        }
                        ?>
                        <span class="glyphicon glyphicon-flag"></span> <?php if ($dir != 'left') {echo $caret;} ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('site_settings/lang/english'); ?>"><?=  lang('english'); ?></a></li>
                        <li><a href="<?= site_url('site_settings/lang/arabic'); ?>"><?=  lang('arabic'); ?></a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>

<?php
if (isset($view_file)) {
    $this->load->view($view_module . '/' . $view_file);
}
?>

<script>
    var root = '<?php echo base_url(); ?>';
</script>
<script src="<?= admin_assets('js/jquery-1.10.2.min.js') ?>"></script>
<script src="<?= admin_assets('js/bootstrap.min.js') ?>"></script>
<?php if ($datatables): ?>
    <script src="<?= admin_assets('js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= admin_assets('js/dataTables.bootstrap.min.js') ?>"></script>
<?php endif; ?>
<?php if (isset($datepicker) && ($datepicker == true)): ?>
    <script src="<?= admin_assets('js/moment.min.js') ?>"></script>
    <script src="<?= admin_assets('js/bootstrap-datetimepicker.min.js') ?>"></script>
    <script>
        $('.datepicker').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#dateyearpicker').datetimepicker({
            viewMode: "years",
            format: "MM/YYYY"
        });
    </script>
<?php endif; ?>
<?php if (isset($datepicker_range) && ($datepicker_range == true) ): ?>
    <script src="<?= admin_assets('js/moment.min.js') ?>"></script>
    <script src="<?= admin_assets('js/daterangepicker.js') ?>"></script>
    <script>
        $('input[name="daterange"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD-MM-YYYY',
                cancelLabel: 'Clear'
            }
        });

  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
  });

  $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

    </script>
<?php endif; ?>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<?php if (isset($ckeditor) && $ckeditor == true):   ?>
<!--    <script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>-->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0nzlvxmbd26ap1y8ar9oofd1ple1nzsylmgaia6tz3mm2hk1"></script>
    <script>
        tinymce.init({selector: '#editor',
            height: 500,
            theme: 'modern',
            plugins: 'print preview powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,

        });
        // ClassicEditor
        //     .create( document.querySelector( '#editor' ), {
        //         toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'aligment' ],
        //     } )
        //     .then( editor => {
        //     console.log( editor );
        // } )
        // .catch( error => {
        //     console.error( error );
        // } );
    </script>
<?php endif; ?>

<?php if (isset($js_files)): ?>
    <?php foreach ($js_files as $js_file): ?>
        <script src="<?php echo site_url($js_file) . '?v=' . filemtime(FCPATH . $js_file); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<script src="<?= admin_assets('js/script.js') . '?v=' . filemtime(FCPATH . 'assets/admin_panel/js/script.js'); ?>"></script>
</body>
</html>