<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Credit Cards</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Credit Cards</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'credit_card/add'; ?>">Add New</a>
                            </li>
                            <?php if ($name == 'ali') {echo 'hi'; } else { echo 'my name is ali abdelna'; } ?>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-usd"></span> Credit Card</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($credit_cards && count($credit_cards)): ?>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Credit Card</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($credit_cards as $credit_card): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $credit_card->credit_card; ?></td>
                                                    <td><?= $credit_card->credit_card_amount ?></td>
                                                    <td>
                                                        <a href="<?= site_url('credit_card/add/' . $credit_card->id) ?>"
                                                           class="btn btn-primary"
                                                           data-toggle="tooltip"
                                                           title="Edit">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('credit_card/delete/' . $credit_card->id); ?>"
                                                           class="btn btn-danger delete-btn" data-toggle="tooltip"
                                                           title="Delete">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no Credit Card added Yet</h2>
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