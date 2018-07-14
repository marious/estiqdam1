<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Site Settings / Upload Site Logo</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'site_settings'; ?>">Institution Details</a>
                            </li>
                            <li class="active">
                                <a href="<?= base_url() . 'site_settings/site_logo'; ?>">Site Logo</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'site_settings/get_translation'; ?>">Translation</a>
                            </li>
                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-picture
"></span> Site Logo</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?= form_open_multipart('site_settings/do_upload', [
                                        'class' => 'form-horizontal']) ?>
                                    <p class="margin-t-20">Please choose a file from your computer and then press 'Upload'.</p>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="fileInput" class="col-sm-2 control-label">File Input</label>
                                            <div class="col-sm-10">
                                                <input type="file" id="fileInput" name="photo" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>


                                        <?php if ($logo): ?>
                                            <div class="logo-container col-md-2 col-md-push-2">
                                                <h4>Existing Logo</h4>
                                                <img src="<?= base_url() . 'assets/img/' . $logo ?>" class="img-thumbnail img-responsive">
                                            </div>
                                            <div class="clearfix"></div>
                                        <?php endif; ?>


                                    <div class="box-footer">
                                        <div class="col-md-4 col-md-push-4">
                                            <button type="submit" class="btn btn-primary btn-block">Upload</button>
                                        </div>

                                    </div>
                                    <?= form_close() ?>
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