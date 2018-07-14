<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Arrival Airports</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Arrival Airports</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'arrival_airports/add'; ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> Arrival Airports</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($arrival_airports && count($arrival_airports)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Name In English</th>
                                                <th>Name In Arabic</th>
                                                <th>Action</th>
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
                                                           title="Edit">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('arrival_airports/delete/' . $airport->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="Delete">
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