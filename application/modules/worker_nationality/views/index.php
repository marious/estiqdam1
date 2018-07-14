<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Worker Nationalities</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Worker Nationalities</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'worker_nationality/add'; ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> Worker Nationalities</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($worker_nationalities && count($worker_nationalities)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Nationality In English</th>
                                                <th>Nationality In Arabic</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($worker_nationalities as $nationality): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $nationality->nationality_in_english; ?></td>
                                                    <td><?= $nationality->nationality_in_arabic ?></td>
                                                    <td>
                                                        <a href="<?= site_url('worker_nationality/add/' . $nationality->id) ?>" class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="Edit">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('worker_nationality/delete/' . $nationality->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="Delete">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no Worker Nationality added Yet</h2>
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