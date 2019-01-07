<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('visa_issued_city'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#"><?= lang('visa_issued_city'); ?></a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'visa_issued_city/add'; ?>"><?= lang('add_new'); ?></a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> <?= lang('visa_issued_city'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($cities && count($cities)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th><?= lang('city'); ?></th>
                                                <th><?= lang('action'); ?></th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($cities as $city): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $city->city; ?></td>
                                                    <td>
                                                        <a href="<?= site_url('visa_issued_city/add/' . $city->id) ?>" class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="<?= lang('edit'); ?>">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('visa_issued_city/delete/' . $city->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="<?= lang('delete'); ?>">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2><?= lang('no_data'); ?></h2>
                                    <?php endif; ?>
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