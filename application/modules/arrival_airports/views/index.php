<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('arrival_airports'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#"><?= lang('arrival_airports'); ?></a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'arrival_airports/add'; ?>"><?= lang('add_new'); ?></a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> <?= lang('arrival_airports'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($arrival_airports && count($arrival_airports)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th><?= lang('name_in_english'); ?></th>
                                                <th><?= lang('name_in_arabic'); ?></th>
                                                <th><?= lang('action'); ?></th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($arrival_airports as $airport): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $airport->name_in_english; ?></td>
                                                    <td><?= $airport->name_in_arabic ?></td>
                                                    <td>
                                                        <a href="<?= site_url('arrival_airports/add/' . $airport->id) ?>" class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="<?= lang('edit'); ?>">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('arrival_airports/delete/' . $airport->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="<?= lang('delete'); ?>">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no staff user added Yet</h2>
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