<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= lang('add_payment') ?></h4>
</div>

<div class="modal-body">

    <form action="<?= site_url('sales/received_payment') ?>" id="add-payment" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label><?= lang('payment_date') ?><span class="required" aria-required="true">*</span></label>
                    <input name="payment_date" value="<?php if(!empty($payment)) echo $payment->payment_date ?>" class="form-control datepicker" type="text" autocomplete="off">
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
                    <input id="amount" name="amount" class="form-control" value="<?php if(!empty($payment)){ echo $payment->amount ;}else{ echo $order->due_payment; } ?>"
                           type="text" onkeyup="receivedAmount(this);">
                    <span style=" color: #E13300" id="msg"></span>
                </div>
            </div>


            <input type="hidden" value="<?php echo $order->due_payment?>" id="due" >


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
                    <!-- /.Start Date -->
                    <div class="form-group form-group-bottom">
                        <label><?= lang('payment_method') ?></label>
                        <select id="method" class="form-control" name="payment_method">
                            <option value="cash" <?php if(!empty($payment)) echo $payment->method == 'cash'?'selected':'' ?>><?= lang('cash') ?></option>
                            <option value="cc" <?php if(!empty($payment)) echo $payment->method == 'cc'?'selected':'' ?>><?= lang('credit_card') ?></option>
                            <option value="ck" <?php if(!empty($payment)) echo $payment->method == 'ck'?'selected':'' ?>><?= lang('cheque') ?></option>
                            <option value="bank" <?php if(!empty($payment)) echo $payment->method == 'bank'?'selected':'' ?>><?= lang('bank_transfer') ?></option>
                        </select>
                    </div>
                </div>

                <div class="cc box" style="border-top: none; display: none;">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="cc_name" value="<?php if(!empty($payment)) echo $payment->cc_name ?>" placeholder="<?= lang('card_holder_name') ?>" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <input name="cc_number" class="form-control" placeholder="CC Number" value="<?php if(!empty($payment)) echo $payment->cc_number ?>"
                                   type="text">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <select class="form-control" name="cc_type">
                                <option value="Visa" <?php if(!empty($payment)) echo $payment->cc_type == 'Visa'?'selected':'' ?>>Visa</option>
                                <option value="Master" <?php if(!empty($payment)) echo $payment->cc_type == 'Master'?'selected':'' ?>>Master Card</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <input name="cc_month" class="form-control" placeholder="Month" value="<?php if(!empty($payment)) echo $payment->cc_month ?>" type="text">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <input name="cc_year" class="form-control" placeholder="Year" value="<?php if(!empty($payment)) echo $payment->cc_year ?>" type="text">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <input name="cvc" class="form-control" placeholder="CVC" value="<?php if(!empty($payment)) echo $payment->cvc ?>" type="text">
                        </div>
                    </div>


                </div>

                <div class="ref box" style="border-top: none; display: none;">
                    <div class="col-md-12">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label><?= lang('ref') ?>.</label>
                            <input name="payment_ref" class="form-control" value="<?php if(!empty($payment)) echo $payment->payment_ref ?>" type="text">
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <input type="hidden" name="order_id" value="<?php echo $order->id ?>">
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
    $('.datepicker').datepicker();

    $("#btn").click(function ()  {

        $("#addPayment").validate({
            excluded: ':disabled',
            rules: {

                cc_name: {
                    required: true
                },
                cc_number: {
                    required: true,
                    number: true
                },
                cc_month: {
                    required: true,
                    number: true
                },
                cc_year: {
                    required: true,
                    number: true
                },
                cvc: {
                    required: true,
                    number: true
                },
                cc_type: {
                    required: true
                },
                payment_ref: {
                    required: true
                },
                payment_date: {
                    required: true
                },
                amount: {
                    required: true,
                    number: true
                },

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
        })
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });


</script>

<script type="text/javascript">

    $("#method").change(function(){
        $(this).find("option:selected").each(function(){
            //var value = $(this).attr("value");
            //alert(value);

            if($(this).attr("value")=="cash"){
                $(".box").hide();
            }
            else if($(this).attr("value")=="cc"){
                $(".box").not(".cc").hide();
                $(".cc").show();
            }
            else{
                $(".box").not(".ref").hide();
                $(".ref").show();
            }
        });
    }).change();

</script>

<script>

    $('#amount').on('keyup', receiveAmount);

    function receiveAmount(arg) {
        const amount = parseFloat($('#amount').val());
        const due = parseFloat($('#due').val());

        if (amount > due) {
            $('#btn').attr('disabled', 'disabled');
            document.getElementById('msg').innerHTML = "<?= lang('received_amount_greater_than_due') ?>";
        } else {
            $('#msg').empty();
            $('#btn').removeAttr('disabled');
        }
    }
</script>