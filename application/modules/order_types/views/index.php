<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Order Types</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Order Types</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'order_types/add'; ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Order Type</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($order_types && count($order_types)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Order Type Name In English</th>
                                                <th>Order Type Name In Arabic</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($order_types as $order_type): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $order_type->name_in_english; ?></td>
                                                    <td><?= $order_type->name_in_arabic ?></td>
                                                    <td>
                                                        <a href="<?= site_url('order_types/add/' . $order_type->id) ?>" class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="Edit">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('order_types/delete/' . $order_type->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="Delete">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no Order Type added Yet</h2>
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