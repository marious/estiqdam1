<div class="container">
    <h1>Welcome <?= $_SESSION['username']; ?> to Peace For Recruitment Dashboard</h1>
    <?php if ($_SESSION['access_id'] == 4): ?>
    <?php
        $this->load->module('agent_worker');
        $not_stamp_workers = $this->agent_worker->Agent_worker_model->get_agent_workers_not_stamp();
        $stamped_not_arrived = $this->agent_worker->Agent_worker_model->get_agent_workers_not_arrived();
        $arrived_workers = $this->agent_worker->Agent_worker_model->get_agent_workers_arrived();
        $accepted_workers = $this->agent_worker->Agent_worker_model->get_accepted_workers_by_agent();

        $not_paid = [];
        if ($arrived_workers && count($arrived_workers)) {
            foreach ($arrived_workers as $worker) {
                $this->db->where('contract_number', $worker->contract_number);
                $query = $this->db->get('agents_payment');
                if ($query->num_rows()) {
                    continue;
                }
                $not_paid[] = $worker;
            }
        }
     ?>
        <div class="col-lg-4 col-xs-6" style="margin-top: 50px;">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 style="font-size: 24px; text-align: center;">Selected Workers</h3>
                    <h3 style="text-align: center; margin-top: 20px;"><?php if ($accepted_workers) {echo count($accepted_workers);} else {echo 0;} ?></h3>
                </div>
                <div class="small-box-footer">
                    <div class="details"><a target="_blank" href="<?= site_url('agent_worker/accepted'); ?>">Details</a></div>
                </div>
            </div>
        </div><!-- ./col-lg-4 -->


        <div class="col-lg-4 col-xs-6" style="margin-top: 50px;">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 style="font-size: 24px; text-align: center;">Workers Not Stamped</h3>
                    <h3 style="text-align: center; margin-top: 20px;"><?php if ($not_stamp_workers) {echo count($not_stamp_workers);} else {echo 0;} ?></h3>
                </div>
                <div class="small-box-footer">
                    <div class="details"><a target="_blank" href="<?= site_url('agent_worker/reports_not_stamp'); ?>">Details</a></div>
                </div>
            </div>
        </div><!-- ./col-lg-4 -->

        <div class="col-lg-4 col-xs-6" style="margin-top: 50px;">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 style="font-size: 20px; text-align: center;">Workers Stamped But Not Traveled</h3>
                    <h3 style="text-align: center; margin-top: 20px;"><?php if ($stamped_not_arrived) {echo count($stamped_not_arrived);} else {echo 0;} ?></h3>
                </div>
                <div class="small-box-footer">
                    <div class="details"><a target="_blank" href="<?= site_url('agent_worker/reports_not_arrived'); ?>">Details</a></div>
                </div>
            </div>
        </div><!-- ./col-lg-4 -->

<div class="clearfix"></div>

        <div class="col-lg-4 col-xs-6" style="margin-top: 50px;">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 style="font-size: 24px; text-align: center;">Arrived Workers</h3>
                    <h3 style="text-align: center; margin-top: 20px;"><?php if ($arrived_workers){ echo count($arrived_workers);} else {echo 0;}; ?></h3>
                </div>
                <div class="small-box-footer">
                    <div class="details"><a target="_blank" href="<?= site_url('agent_worker/reports_arrived'); ?>">Details</a></div>
                </div>
            </div>
        </div><!-- ./col-lg-4 -->

        <div class="col-lg-4 col-xs-6" style="margin-top: 50px;">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 style="font-size: 24px; text-align: center;">Not Paid For Recruitment</h3>
                    <h3 style="text-align: center; margin-top: 20px;"><?= count($not_paid); ?></h3>
                </div>
                <div class="small-box-footer">
                    <div class="details"><a target="_blank" href="<?= site_url('agent_worker/payment_report'); ?>">Details</a></div>
                </div>
            </div>
        </div><!-- ./col-lg-4 -->

    <?php endif; ?>
</div>