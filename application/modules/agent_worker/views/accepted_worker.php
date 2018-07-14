<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> </div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($worker && count($worker)): ?>
                                        <table id="services_table" class="table table-bordered table-striped services-table">
                                            <thead>
                                            <tr>
                                                <th>Worker Name</th>
                                                <th>Passport Number</th>
                                                <th>Stamp Date</th>
                                                <th>Arrived Date</th>
                                                <th>Upload Documents</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $worker->worker_name_in_english; ?></td>
                                                    <td><?= $worker->passport_number; ?></td>
                                                    <td><?= $worker->stamp_date; ?></td>
                                                    <td><?= $worker->arrived_date; ?></td>
                                                    <td><button type="button" name="upload" class="upload btn btn-success btn-xs">Upload Documents</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <h2>Not Contracts Found</h2>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div>

        <div class="panel panel-default m-t">
            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> Existing Documents</div>
            <div class="panel-body">
                <div class="tab-content m-t">
                    <div class="row">

                        <?php if(isset($worker)): ?>


                            <?php if ($worker->stamping_image != '0'): ?>
                                <div class="col-md-4">
                                    <a href="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->stamping_image); ?>" data-lightbox="image-gallery" data-title="Stamping Image" target="_blank">
                                        <img src="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->stamping_image); ?>" class="img-thumbnail small-img">
                                    </a>
                                    <div class="title">Stamping Image</div>
                                </div>
                            <?php endif; ?>

                            <?php if ($worker->contract_image != '0'): ?>
                            <div class="col-md-4">
                                <a href="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->contract_image); ?>" data-lightbox="image-gallery" data-title="Contract Image" target="_blank">
                                    <img src="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->contract_image); ?>" class="img-thumbnail small-img">
                                </a>
                                <div class="title">Contract Image</div>
                            </div>
                        <?php endif; ?>


                            <?php if ($worker->visa_image != '0'): ?>
                                <div class="col-md-4">
                                    <a href="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->visa_image); ?>" data-lightbox="image-gallery" data-title="Visa Image" target="_blank">
                                        <img src="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->visa_image); ?>" class="img-thumbnail small-img">
                                    </a>
                                    <div class="title">Visa Image</div>
                                </div>
                            <?php endif; ?>

                            <?php if ($worker->delegation_image != '0'): ?>
                                <div class="col-md-4">
                                    <a href="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->delegation_image); ?>" data-lightbox="image-gallery" data-title="Delegation Image" target="_blank">
                                        <img src="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->delegation_image); ?>" class="img-thumbnail small-img">
                                    </a>
                                    <div class="title">Delegation Image</div>
                                </div>
                            <?php endif; ?>

                            <?php if ($worker->id_image != '0'): ?>
                                <div class="col-md-4">
                                    <a href="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->id_image); ?>" data-lightbox="image-gallery" data-title="ID Image" target="_blank">
                                        <img src="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->id_image); ?>" class="img-thumbnail small-img">
                                    </a>
                                    <div class="title">ID Image</div>
                                </div>
                            <?php endif; ?>

                            <?php if ($worker->ticket_image != '0'): ?>
                                <div class="col-md-4">
                                    <a href="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->ticket_image); ?>" data-lightbox="image-gallery" data-title="Ticket Image" target="_blank">
                                        <img src="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->ticket_image); ?>" class="img-thumbnail small-img">
                                    </a>
                                    <div class="title">Ticket Image</div>
                                </div>
                            <?php endif; ?>


                            <?php if ($worker->passport_image != '0'): ?>
                                <div class="col-md-4">
                                    <a href="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->passport_image); ?>" data-lightbox="image-gallery" data-title="Passport Image" target="_blank">
                                        <img src="<?= site_url('assets/contracts/' . $worker->contract_number .'/' . $worker->passport_image); ?>" class="img-thumbnail small-img">
                                    </a>
                                    <div class="title">Passport Image</div>
                                </div>
                            <?php endif; ?>


                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>

    </div>

</section>



<div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Files</h4>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('agent_worker/processing_upload'); ?>" method="post" id="upload_form" enctype='multipart/form-data' class="form-horizontal">



                    <div class="form-group">
                        <label for="stamping_image" class="control-label col-md-3">Stamp Image</label>
                        <div class="col-md-6">
                            <input type="file" name="stamping_image" id="stamping_image" class="form-control">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="ticket_image" class="control-label col-md-3">Ticket Image</label>
                        <div class="col-md-6">
                            <input type="file" name="ticket_image" id="ticket_image" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="passport_image" class="control-label col-md-3">Passport Image</label>
                        <div class="col-md-6">
                            <input type="file" name="passport_image" id="ticket_image" class="form-control">
                        </div>
                    </div>






                    <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
                    <input type="hidden" name="contract_number" value="<?= $worker->contract_number; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>