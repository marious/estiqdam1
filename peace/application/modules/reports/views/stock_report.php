<div class="row">
    <div class="col-md-12">
        <div class="wrap-fpanel">
            <div class="box box-primary" data-collapsed="0">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title"><?= lang('stock_report') ?></h3>
                </div>
                <div class="panel-body">
                    <?php if (is_array($products) && count($products)): ?>
                        <table class="table table-striped table-bordered display-all" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><?= lang('sl') ?>.</th>
                                <th><?= lang('sku') ?></th>
                                <th><?= lang('product') ?></th>
                                <th><?= lang('inventory') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($products as $item): ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $item->item_code ?></td>
                                    <td><?= $item->name ?></td>
                                    <td><?= $item->inventory ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>