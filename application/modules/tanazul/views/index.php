<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">التنازلات</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> التنازلات</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($advs && count($advs)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>نص الاعلان</th>
                                                <th>رقم التواصل</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($advs as $adv): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $adv->adv_text; ?></td>
                                                    <td><?= $adv->mobile_number; ?></td>
                                                    <td>
                                                        <a href="<?= site_url('tanazul/add/' . $adv->id) ?>" class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="Edit">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('tanazul/delete/' . $adv->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="Delete">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no data Yet.</h2>
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