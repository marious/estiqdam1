<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header"></div>

                <div class="page-header">
                    <h3 class="page-title">Process Contract</h3>
                </div>

                <?php if (isset($view_service) && $view_service == true): ?>

                    <div class="panel panel-default m-t">
                        <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('services'); ?></div>
                        <div class="panel-body">
                            <div class="tab-content m-t">
                                <?php $this->load->view('includes/flash_messages'); ?>
                                <?php if ($service && count($service)): ?>
                                    <table id="services_table" class="table table-bordered table-striped services-table">
                                        <thead>
                                        <tr>
                                            <th width="25%">اسم العميل</th>
                                            <th width="25%">اسم العامل</th>
                                            <th width="10%">المندوب</th>
                                            <th>تاريخ التفويض</th>
                                            <th>تاريخ التفييز</th>
                                            <th>تاريخ الوصول</th>
                                            <th>رفع الملفات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="contract_data">
                                            <tr>
                                                <td><?php echo $service->customer_name_in_arabic; ?></td>
                                                <td><?php echo $service->worker_name_in_english; ?></td>
                                                <td><?php echo $service->representative_name; ?></td>
                                                <td class="delegation_date" data-type="date" data-name="delegation_date"
                                                data-pk="<?= $service->contract_number; ?>">
                                                    <?php  echo ($service->delegation_date != null) ? date('d-m-Y', strtotime($service->delegation_date)) : ''; ?>
                                                </td>
                                                <td class="stamping_date" data-type="date" data-name="stamp_date" data-pk="<?= $service->contract_number; ?>"><?php  echo ($service->stamp_date != null) ? date('d-m-Y', strtotime($service->stamp_date)) : ''; ?></td>
                                                <td class="arrived_date" data-type="date" data-name="arrived_date" data-pk="<?= $service->contract_number ?>"><?php echo ($service->arrived_date != null) ?  date('d-m-Y', strtotime($service->arrived_date)) : ''; ?></td>
                                                <td>
                                                    <button type="button" name="upload" class="upload btn btn-success btn-xs">رفع الملفات</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <h2><?= lang('no_service'); ?></h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>


                <div class="panel panel-default m-t">
                    <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> الوثائق الموجودة</div>
                    <div class="panel-body">
                        <div class="tab-content m-t">
                            <div class="row">

                                <?php if(isset($service)): ?>
                                <?php if ($service->visa_image != '0'): ?>
                                  <div class="col-md-4">
                                      <a href="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->visa_image); ?>" data-lightbox="image-gallery" data-title="صورة التأشيرة">
                                          <img src="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->visa_image); ?>" class="img-thumbnail small-img">
                                      </a>
                                      <div class="title">صورة التأشيرة</div>
                                  </div>
                                <?php endif; ?>

                                <?php if ($service->id_image != '0'): ?>
                                    <div class="col-md-4">
                                        <a href="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->id_image); ?>" data-lightbox="image-gallery" data-title="صورة الهوية">
                                            <img src="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->id_image); ?>" class="img-thumbnail small-img">
                                        </a>
                                        <div class="title">صورة الهوية</div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($service->contract_image != '0'): ?>
                                    <div class="col-md-4">
                                        <a href="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->contract_image); ?>" data-lightbox="image-gallery" data-title="صورة العقد">
                                            <img src="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->contract_image); ?>" class="img-thumbnail small-img">
                                        </a>
                                        <div class="title">صورة العقد</div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($service->delegation_image != '0'): ?>
                                    <div class="col-md-4">
                                        <a href="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->delegation_image); ?>" data-lightbox="image-gallery" data-title="صورة التفويض">
                                            <img src="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->delegation_image); ?>" class="img-thumbnail small-img">
                                        </a>
                                        <div class="title">صورة التفويض</div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($service->stamping_image != '0'): ?>
                                    <div class="col-md-4">
                                        <a href="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->stamping_image); ?>" data-lightbox="image-gallery" data-title="صورة التفييز">
                                            <img src="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->stamping_image); ?>" class="img-thumbnail small-img">
                                        </a>
                                        <div class="title">صورة التفييز</div>
                                    </div>
                                <?php endif; ?>

                                    <?php if ($service->ticket_image != '0'): ?>
                                        <div class="col-md-4">
                                            <a href="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->ticket_image); ?>" data-lightbox="image-gallery" data-title="صورة التذكرة">
                                                <img src="<?= site_url('assets/contracts/' . $service->contract_number .'/' . $service->ticket_image); ?>" class="img-thumbnail small-img">
                                            </a>
                                            <div class="title">صورة التذكرة</div>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($service->passport_image != '0' && $service->passport_image != ''): ?>
                                        <div class="col-md-4">
                                            <!--<a href="<?php //echo e_url('assets/img/workers' . '/' . $service->passport_image); ?>" data-lightbox="image-gallery" data-title="صورة الجواز">
                                                <img src="<?php  //echo site_url('assets/img/workers' . '/' . $service->passport_image); ?>" class="img-thumbnail small-img">
                                            </a> -->
                                            <a href="<?= site_url('assets/contracts/' . $service->contract_number . '/' . $service->passport_image) ?>" data-lightbox="image-gallery" data-title="صورة الجواز">
                                                <img src="<?= site_url('assets/contracts/' . $service->contract_number  . '/' . $service->passport_image); ?>" class="img-thumbnail small-img">
                                            </a>
                                            <div class="title">صورة الجواز</div>
                                        </div>
                                    <?php endif; ?>


                                <?php endif; ?>


                            </div>
                        </div>
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
                <form action="<?= site_url('services_entry/processing_upload'); ?>" method="post" id="upload_form" enctype='multipart/form-data' class="form-horizontal">

                    <div class="form-group">
                        <label for="visa_image" class="control-label col-md-3">صورة التأشيرة</label>
                        <div class="col-md-6">
                            <input type="file" name="visa_image" id="visa_image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_image" class="control-label col-md-3">صورة الهوية</label>
                        <div class="col-md-6">
                            <input type="file" name="id_image" id="id_image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contract_image" class="control-label col-md-3">صورة العقد</label>
                        <div class="col-md-6">
                            <input type="file" name="contract_image" id="contract_image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="delegation_image" class="control-label col-md-3">صورة التفويض</label>
                        <div class="col-md-6">
                            <input type="file" name="delegation_image" id="delegation_image" class="form-control">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="ticket_image" class="control-label col-md-3">صورة التذكرة</label>
                        <div class="col-md-6">
                            <input type="file" name="ticket_image" id="ticket_image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stamping_image" class="control-label col-md-3">صورة التفييز</label>
                        <div class="col-md-6">
                            <input type="file" name="stamping_image" id="stamping_image" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="passport_image" class="control-label col-md-3">صورة الجواز</label>
                        <div class="col-md-6">
                            <input type="file" name="passport_image" id="passport_image" class="form-control">
                        </div>
                    </div>


                    <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
                    <input type="hidden" name="contract_number" value="<?= $service->contract_number; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>