<div class="row">
    <div class="col-md-12">
        <div class="wrap-fpanel">
            <div class="box box-primary" data-collapsed="0">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title"><?= lang('stock_values') ?></h3>
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
                                <th><?= lang('total') ?> <?= lang('purchase_cost') ?> </th>
                                <th><?= lang('total') ?> <?= lang('selling_cost') ?></th>
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
                            <td><?= currency($item->purchase_cost * $item->inventory) ?></td>
                            <td><?= currency($item->sales_price * $item->inventory) ?></td>
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