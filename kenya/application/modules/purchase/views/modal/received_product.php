<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= lang('close') ?></span></button>
    <h4 class="modal-title" id="myModalLabel"><?= lang('purchase_invoice') ?># <?php echo INVOICE_PRE + $purchase_order->id ?></h4>
</div>

<div class="modal-body">
    <?= form_open('purchase/submit_received_product') ?>
    <table class="table table-bordered table-hover purchase-products" id="myTable">
        <thead>
            <tr>
                <th class="active col-sm-1"><?= lang('sl') ?></th>
                <th class="active"><?= lang('product') ?></th>
                <th class="active"><?= lang('purchase_qty') ?></th>
                <th class="active"><?= lang('received') ?></th>
                <th class="active"><?= lang('received') ?> <?= lang('qty') ?></th>

            </tr>
        </thead>
        <tbody>
            <?php if (is_array($purchase_product) && count($purchase_product)): ?>
            <?php $i = 1; foreach ($purchase_product as $product): ?>
                <tr class="custom-tr">
                    <td class="vertical-td"><?= $i ?></td>
                    <td class="vertical-td"><?= $product->product_name ?> <span style="color: #E13300;" id="<?= 'msg'.$product->id ?>"></span></td>
                    <td class="vertical-td"><?= $product->qty ?></td>
                    <td class="vertical-td"><?= $product->total_received ?></td>
                    <td class="vertical-td">
                        <input type="text" class="form-control" name="qty[]" style="width: 100px;" <?= $product->qty == $product->total_received ? 'readonly' : '' ?>
                            onkeyup="receivedPurchase(this)" id="<?= 'rec_qty'.$product->id ?>" autocomplete="off">
                    </td>

                    <input type="hidden" id="<?= 'pur_qty'.$product->id ?>" value="<?= $product->qty ?>">
                    <input type="hidden" id="<?= 'tot_qty'.$product->id ?>" value="<?= $product->total_received ?>">

                    <input type="hidden" name="id[]" value="<?= $product->id ?>">

                </tr>
            <?php $i++; endforeach; ?>
                <tr>
                    <td colspan="4"></td>
                    <td class="vertical-td">
                        <button type="submit" class="btn bg-navy" id="sbtn"><?= lang('update') ?>
                        </button>
                    </td>

                </tr>
            <?php else: ?>
                <td colspan="6">
                    <strong><?= lang('there_is_no_record_for_display') ?></strong>
                </td>
            <?php endif; ?>
        </tbody>
    </table>

    <input type="hidden" value="<?php echo $purchase_order->id ?>" name="order_id">
    <?= form_close() ?>
</div>


<script>



    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    function receivedPurchase(arg) {
        let val = arg.getAttribute('id');
        let id = val.slice(7);
        let qty = parseInt($('#rec_qty'+id).val());
        let purchaseQty = parseInt($('#pur_qty'+id).val());
        let totalReceivedQtyValue = parseInt($('#tot_qty'+id).val());
        let value = qty + totalReceivedQtyValue;

        if (value > purchaseQty) {
            $('#sbtn').attr('disabled', 'disabled');
            document.getElementById('msg'+id).innerHTML = "<?= lang('higher_than_purchase_qty') ?>";
        } else {
            $('#msg'+id).empty();
        }

        let ids = [];
        $('#myTable').find('span').each(function() {
            ids.push(this.id);
        });

        for (let i = ids.length - 1; i >= 0; i--) {
            if ($('#'+ids[i]).is(':empty')) {
                ids.splice(i, 1);
            }
        }

        let flag = ids.length;
        if (flag == 0) {
            $('#sbtn').removeAttr('disabled');
        }
    }


</script>