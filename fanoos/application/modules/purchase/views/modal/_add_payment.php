<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= lang('add_payment') ?></h4>
</div>

<div class="modal-body">

    <form action="<?= site_url('purchase/received_payment') ?>" id="add-payment" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?= lang('payment_date') ?><span class="required" aria-required="true">*</span></label>
                    <input name="payment_date" value="<?php if(!empty($payment)) echo $payment->payment_date ?>" class="form-control datepicker"
                           data-date-format="dd/mm/yyyy" type="text" autocomplete="off">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group form-group-bottom">
                    <label><?= lang('reference_no') ?>.</label>
                    <input name="order_ref" class="form-control" value="<?php if(!empty($payment)) echo $payment->order_ref ?>" type="text">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group form-group-bottom">
                    <label><?= lang('received_amount') ?></label>
                    <input id="amount" name="amount" class="form-control" value="<?php if(!empty($payment)){ echo $payment->amount ;}else{ echo $purchase_order->due_payment; } ?>" type="text"
                           onkeyup="receivedAmount(this);">
                    <span style="color: #E13300" id="msg"></span>
                </div>
            </div>

            <input type="hidden" value="<?php echo $purchase_order->due_payment?>" id="due" >

            <div class="col-md-6">
                <div class="form-group form-group-bottom">
                    <label><?= lang('attachment') ?></label>
                    <input name="bill"  value="" type="file">
                </div>
            </div>

        </div>

        <div class="well well-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-bottom">
                        <label for="from_account"><?= lang('from_account') ?></label>
                        <select  id="from_account" name="from_account" class="form-control">
                            <option value="">-- <?= lang('select_account') ?> --</option>
                            <?php if (is_array($accounts) && count($accounts)): ?>
                            <?php foreach ($accounts as $account): ?>
                                    <option value="<?= $account->id ?>"><?= $account->account ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>


                <div class="col-md-12">
                    <!-- /.Start Date -->
                    <div class="form-group form-group-bottom">
                        <label><?= lang('payment_method') ?></label>
                        <select id="method" class="form-control" name="payment_method">
                            <option value="">-- <?= lang('select_payment_method') ?> --</option>
                            <option value="cash" <?php if(!empty($payment)) echo $payment->method == 'Cash'?'selected':'' ?>><?= lang('cash') ?></option>
                            <option value="bank" <?php if(!empty($payment)) echo $payment->method == 'bank'?'selected':'' ?>><?= lang('bank_transfer') ?></option>
                        </select>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group form-group-bottom">
                        <label for="from_account"><?= lang('category') ?></label>
                        <select  id="category" name="category" class="form-control">
                            <option value="">-- <?= lang('select_category') ?> --</option>
                            <?php if (is_array($categories) && count($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>


                <div class="col-md-12">
                    <!-- /.Start Date -->
                    <div class="form-group form-group-bottom">
                        <label><?= lang('description') ?></label>
                        <input type="text" class="form-control" name="description">
                    </div>
                </div>

            </div>
        </div>


        <input type="hidden" name="order_id" value="<?php echo $purchase_order->id ?>">
        <input type="hidden" name="payment_id" value="<?php if(!empty($payment))echo $payment->id ?>">


        <div class="modal-footer" >

            <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><?= lang('close') ?></button>
            <button type="submit" class="btn bg-olive btn-flat" id="btn" ><?= lang('save') ?></button>

        </div>

    </form>

</div>


<script>
    $('#modalSmall').on('hidden.bs.modal', function () {
        location.reload();
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    $('#btn').on('click', function() {
       $('#add-payment').validate({
           excluded: ':disabled',
           rules: {
               payment_ref: {
                  // required: true
               },
               payment_date: {
                   required: true
               },
               amount: {
                   required: true,
                   number: true
               },
               from_account: {
                   required: true,
               },
               payment_method: {
                   required:true,
               },
               category: {
                   required: true,
               },

               highlight: function(element) {
                   $(element).closest('.form-group').addClass('has-error');
               },
               unhighlight: function(element) {
                   $(element).closest('.form-group').removeClass('has-error');
               },

               errorElement: 'span',
               errorClass: 'help-block animated fadeInDown',
               errorPlacement: function(error, element) {
                   if (element.parent('.input-group').length) {
                       error.insertAfter(element.parent());
                   } else {
                       error.insertAfter(element);
                   }
               }

           }
       });
    });

    function receivedAmount(arg) {
        let amount = parseFloat($('#amount').val());
        let due = parseFloat($('#due').val());

        if (amount > due) {
            $('#btn').attr('disabled', 'disabled');
            document.getElementById('msg').innerHTML = "<?= lang('received_amount_greater_than_due') ?>";
        } else {
            $('#msg').empty();
            $('#btn').removeAttr('disabled');
        }
    }
</script>