<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">View Payment</h4>
</div>

<div class="modal-body">
    <?php if (is_array($payment) && count($payment)): ?>
    <table class="table table-bordered">
        <thead>
            <tr class="active">
                <th><?= lang('date') ?></th>
                <th><?= lang('payment_ref') ?></th>
                <th><?= lang('payment_method') ?></th>
                <th><?= lang('amount') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($payment as $item): ?>
            <tr>
                <td><?= dateFormat($item->payment_date) ?></td>
                <td><?= $item->order_ref ?></td>
                <td><?= $item->payment_method ?></td>
                <td>
                    <?= currency($item->amount) ?>
                </td>
                <td></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<style>
    #modalSmall .modal-dialog
    {
        width: 50% !important;
    }
</style>


<script>


    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
</script>