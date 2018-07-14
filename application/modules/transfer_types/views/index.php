<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Transfer Types</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Transfer Types</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'transfer_types/add'; ?>">Add New Type</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Transfer</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($transfer_types && count($transfer_types)): ?>
                                        <table id="customers_table" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Transfer Type</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($transfer_types as $type): ?>
                                            <tr>
                                                <td><?= $type->type; ?></td>
                                                <td>
                                                    <?php
                                                    if ($type->parent_id != 0)
                                                    {
                                                        $this->load->module('transfer_types');
                                                        echo $this->transfer_types->get_type_by_id($type->parent_id);
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('transfer_types/add/' . $type->id); ?>" class="btn btn-success">Update</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is Transfer Type added</h2>
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


