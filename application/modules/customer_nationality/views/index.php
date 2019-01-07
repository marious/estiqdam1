<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('customer_nationalities'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#"><?= lang('customer_nationalities'); ?></a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'customer_nationality/add'; ?>"><?= lang('add_new') ?></a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> <?= lang('customer_nationalities'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($customer_nationalities && count($customer_nationalities)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th><?= lang('nationality_in_english'); ?></th>
                                                <th><?= lang('nationality_in_arabic'); ?></th>
                                                <th><?= lang('action') ?></th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($customer_nationalities as $nationality): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $nationality->nationality_in_english; ?></td>
                                                    <td><?= $nationality->nationality_in_arabic ?></td>
                                                    <td>
                                                        <a href="<?= site_url('customer_nationality/add/' . $nationality->id) ?>" class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="Edit">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('customer_nationality/delete/' . $nationality->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="Delete">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2><?= lang('no_customer_nationality'); ?></h2>
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