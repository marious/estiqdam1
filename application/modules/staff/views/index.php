<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Staff</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                    <a href="#">Staff</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'staff/add_user_staff'; ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Staff</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($staff && count($staff)): ?>
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Username</th>
                                            <th>Access Level</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach ($staff as $user): ?>
                                            <tr>
                                                <td><?= $user->username; ?></td>
                                                <td><?= $user->access; ?></td>
                                                <td>
                                                    <?php
                                                    switch ($user->access_id) {
                                                        case 4:
                                                            $link = 'staff/add_user_staff/' . $user->id;
                                                            break;
                                                        case 1:
                                                            $link = 'staff/add_user_staff/' . $user->id;
                                                            break;
                                                        case 2:
                                                            $link = 'staff/add_user_staff/' . $user->id;
                                                            break;
                                                        case 3:
                                                            $link = 'staff/add_user_staff/' . $user->id;
                                                            break;
                                                    }
                                                    ?>
                                                    <a href="<?= site_url($link) ?>" class="btn btn-primary"
                                                       data-toggle="tooltip"
                                                            title="Edit">
                                                        <span class="glyphicon glyphicon-edit"></span>
                                                    </a>

                                                    <a href="<?= site_url('staff/delete/' . $user->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip" title="Delete">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>
                                                </td>
                                            </tr>
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