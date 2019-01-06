<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Selected Workers</h3>
                    <p class="warngin-msg">! Note You can Update Contract Received Date And MEMO By Clicking
                    On It And Then Click On Right Sign To Save.</p>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> Selected Workers</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table id="accepted_table" class="table table-bordered table-striped services-table accepted-table-2">
                                        <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Name Of Worker</th>
                                                <th>Name Of Customer</th>
                                                <th>Customer ID</th>
                                                <th>Visa Number</th>
                                                <th>Contract Received</th>
                                                <th>Biometric Date</th>
                                                <th>Owwa Schedule</th>
                                                <th>MEMO</th>
                                                <th>Documents</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="accepted-workers">
                                        <?php $i = 1; ?>
                                        <?php foreach ($workers as $worker): ?>
                                           <tr>
                                               <td style="text-align: center; width: 3%;"><?=  $i; ?></td>
                                               <td style="width: 16%;"><?= $worker->worker_name_in_english; ?></td>
                                               <td style="width: 15%;"><?= $worker->customer_name_in_english; ?></td>
                                               <td style="width: 6%; text-align: center;"><?= $worker->customer_id; ?></td>
                                               <td style="width: 6%; text-align: center;"><?= $worker->visa_number; ?></td>
                                               <td class="contract_received_date" style="text-align: center; width: 10%;" data-type="date" data-name="contract_received_date"
                                                data-pk="<?= $worker->worker_id; ?>">
                                                   <?php if ($worker->contract_received_date) { echo strpos($worker->contract_received_date, '/')  ?
                                                            DateTime::createFromFormat('d/m/Y', $worker->contract_received_date)->format('j-M-y') : date('j-M-y', strtotime($worker->contract_received_date));} else {echo '';}; ?>
                                               </td>

                                               <td style="width: 8%; text-align: center;" class="biometric_date" data-type="date" data-name="biometric_date" data-pk="<?= $worker->worker_id; ?>">
                                                   <?php if ($worker->biometric_date){ echo  strpos($worker->biometric_date, '/') ? DateTime::createFromFormat('d/m/Y', $worker->biometric_date)->format('j-M-y') : date('j-M-y', strtotime($worker->biometric_date)); }else {echo '';};?>
                                               </td>
                                               <td style="width: 10%;" class="owwa_sched" data-type="textarea" data-name="owwa_sched" data-pk="<?= $worker->worker_id; ?>">
                                                   <?= $worker->owwa_sched; ?>
                                               </td>
                                               <td style="text-align; center;" class="memo" data-type="textarea"
                                                data-name="memo" data-pk="<?= $worker->worker_id; ?>"><?= $worker->memo; ?></td>
                                               <td style="width: 5%; text-align: center">
                                                   <a href="<?php echo site_url('agent_worker/view_documents_for_pdf/' . $worker->contract_number); ?>/<?= url_title($worker->worker_name_in_english); ?>"><i class='glyphicon glyphicon-file'></i></a>
                                                   <a class='accept-link' href="<?php echo site_url('agent_worker/view_documents/' . $worker->contract_number);?> ">
                                                       <i class='glyphicon glyphicon-eye-open'></i></a>
                                               </td>
                                               <td width="5%"><a href="<?= site_url('agent_worker/add/' . $worker->worker_id); ?>" class="btn btn-xs btn-primary" target="_blank">Update Worker</a></td>
                                           </tr>

                                        <?php $i++; endforeach; ?>

                                        </tbody>
                                    </table>
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