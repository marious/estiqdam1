<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('site_settings'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="<?= base_url() . 'site_settings'; ?>"><?= lang('institution_details'); ?></a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'site_settings/site_logo'; ?>">Site Logo</a>
                            </li>
                            <li class="active">
                                <a href="<?= base_url() . 'site_settings/get_translation'; ?>">Translation</a>
                            </li>
                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><?= lang('language_settings'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <div>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New Language</button>
                                    </div>
                                    <br>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach (langOption() as $lang): ?>
                                            <tr>
                                                <td><?= $lang['name'] ?></td>
                                                <td>
                                                    <a href="<?= site_url('site_settings/get_translation_edit?edit=' . $lang['folder']); ?>" class="btn btn-primary btn-sm">
                                                        Manage
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?= site_url('site_settings/post_add_translation') ?>" class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Language</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="language_name" class="control-label col-md-4">Language Name</label>
                        <div class="col-md-4">
                            <input type="text" name="language_name" id="language_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="language_direction" class="control-label col-md-4">Language Direction</label>
                        <div class="col-md-4" style="margin-top: 10px;">
                            <label><input type="radio" class="" name="language_direction" value="rtl"> RTL</label>
                            &nbsp; &nbsp;
                            <label><input type="radio" class="" name="language_direction" value="ltr"> LTR</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </form>
    </div>
</div>