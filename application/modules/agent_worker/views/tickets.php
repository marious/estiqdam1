<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Tickets </h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Tickets</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">

                                    <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <?= $this->session->flashdata('success'); ?>
                                    </div>
                                    <?php endif; ?>

                                    <table id="" class="table table-bordered table-striped services-table">
                                        <thead>
                                        <tr>
                                            <th>Given Name</th>
                                            <th>Surname</th>
                                            <th>Date Of Birth</th>
                                            <th>Passport Number</th>
                                            <th>Expiry Date</th>
                                            <th>Arrival Airport</th>
                                            <th>Sponsor</th>
                                            <th>Ticket</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <?php if ($agent->nationality_id == 11): ?>
                                        <tbody>
                                        <?php foreach ($tickets as $ticket): ?>
                                        <tr>
                                            <td><?= $ticket->first_name; ?></td>
                                            <td><?= $ticket->sur_name; ?></td>
                                            <td><?= $ticket->date_of_birth; ?></td>
                                            <td><?= $ticket->passport_number; ?></td>
                                            <td><?= $ticket->date_of_expiry; ?></td>
                                            <td><?= $ticket->arrival_airport; ?></td>
                                            <td><?= $ticket->customer_name_in_english; ?></td>
                                            <td>
                                                <?php if ($ticket->ticket_image != '0'): ?>
                                                <div class="col-md-4">
                                                    <a href="<?= site_url('assets/contracts/' . $ticket->contract_number .'/' . $ticket->ticket_image); ?>" class="btn btn-xs btn-success" target="_blank">
                                                        View Ticket
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button  type="button" class="btn btn-warning btn-xs upload" data-contract-number="<?= $ticket->contract_number; ?>">Upload Ticket</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <?php endif; ?>

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



<div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload File</h4>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('agent_worker/upload_agent_ticket'); ?>" method="post" id="upload_form" enctype='multipart/form-data' class="form-horizontal">


                    <div class="form-group">
                        <label for="ticket_image" class="control-label col-md-3">Ticket Photo</label>
                        <div class="col-md-6">
                            <input type="file" name="ticket_image" id="ticket_image" class="form-control">
                        </div>
                    </div>


                    <input type="hidden" id="contract-number" name="contract_number" value="">

                    <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>