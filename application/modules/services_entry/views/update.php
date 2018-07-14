<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('contracts'); ?> </h3>
                </div>
                <?php $this->load->view('includes/flash_messages'); ?>
                <!-- page header -->
                <div class="page-content-wrapper m-t services-entry-form">


                    <form method="post" action="<?= site_url('services_entry/update/' . $contract->contract_number); ?>">
                        <!-- service contract -->

                        <?php include '_includes/contract_service_update.php' ?>
                        <?php include '_includes/customer_service_update.php'; ?>
                        <?php include '_includes/worker_service_update.php'; ?>

                    </form>
                    <!-- ./Service Contract -->

                    <!-- Customer Information -->

                    <!-- ./Customer Information -->


                </div>


            </div>
        </div>
        <!-- ./page-header -->
    </div>
    </div>
    </div>
</section>