<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Jobs</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Jobs</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'jobs/add'; ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> Jobs</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($jobs && count($jobs)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Job Name In English</th>
                                                <th>Job Name In Arabic</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($jobs as $job): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $job->name_in_english; ?></td>
                                                    <td><?= $job->name_in_arabic ?></td>
                                                    <td>
                                                        <a href="<?= site_url('jobs/add/' . $job->id) ?>" class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="Edit">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('jobs/delete/' . $job->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="Delete">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no Job added Yet</h2>
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