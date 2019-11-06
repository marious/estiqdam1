<div class="row">
    <div class="col-md-12">

        <div class="wrap-fpanel">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title"><?= lang('customer') ?> <?= lang('life_time_sell') ?> </h3>
                </div>

                <div class="panel-body">
                    <?= form_open('reports/customerLifetimeSales', ['class' => 'form-horizontal']) ?>

                    <div class="panel_controls">


                        <div class="form-group">
                            <label for="customer_id" class="col-sm-3 control-label"><?= lang('customer') ?></label>
                            <div class="col-sm-5">
                                <select name="customer_id" id="customer_id" class="form-control select2">
                                    <option value=""><?= lang('please_select') ?>...</option>
                                    <?php if(is_array($customers) && count($customers)): ?>
                                        <?php foreach ($customers as $item): ?>
                                            <option value="<?= $item->id ?>"><?= $item->title ?></option>
                                        <?php  endforeach; ?>
                                    <?php  endif; ?>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('submit') ?></button>
                            </div>
                        </div>


                    </div>

                    <input type="hidden" name="flag" value="1">
                    <?= form_close() ?>

                    <?php if (isset($sales) && !empty($sales)): ?>
                        <table class="table table-striped table-bordered display-all" cellspacing="0" style="width: 40%;">

                            <thead>

                            <tr>
                                <th><?= lang('customer') ?> <?= lang('life_time_sell') ?></th>
                                <td></td>
                            </tr>

                            </thead>


                            <tbody>
                            <tr>
                                <td style="width: 50px"><?= lang('customer_name') ?>:</td>
                                <td><?=  $customer->title ?></td>
                            </tr>

                            <tr>
                                <td><?= lang('total') ?> <?= lang('sales') ?>:</td>
                                <td><?= $sales->total_sales ?></td>
                            </tr>


                            <tr>
                                <td><?= lang('total') ?> <?= lang('amount') ?></td>
                                <td><?= currency($sales->grand_total) ?></td>
                            </tr>

                            <tr>
                                <td><?= lang('discount') ?> <?= lang('total') ?></td>
                                <td><?= currency($sales->discount_total) ?></td>
                            </tr>


                            <tr>
                                <td><?= lang('received_amount') ?></td>
                                <td><?= currency($sales->received_amount) ?></td>
                            </tr>

                            <tr>
                                <td><?= lang('payment_due') ?></td>
                                <td><?= currency($sales->due_payment) ?></td>
                            </tr>

                            </tbody>
                        </table>
                    <?php  endif; ?>

                </div>

            </div>
        </div>

    </div>
</div>