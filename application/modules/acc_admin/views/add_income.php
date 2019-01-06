
<!--Statt Main Content-->
<section>
    <div class="main-content <?= get_content_main_area_class(); ?>">
        <div class="row">
            <div class="inner-contatier">
                <div class="col-md-12 col-lg-12 col-sm-12 content-title"><h4>Income</h4></div>

                <!--Alert-->
                <div class="system-alert-box">
                    <div class="alert alert-success ajax-notify"></div>
                </div>
                <!--End Alert-->

                <div class="col-md-5 col-lg-5 col-sm-5">
                    <!--Start Panel-->
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><?= lang('add_income'); ?></div>
                        <div class="panel-body add-client">
                            <form id="add-income">
                                <input type="hidden" name="action" id="action" value="insert"/>
                                <input type="hidden" name="trans_id" id="trans_id" value=""/>
                                <div class="form-group">
                                    <label for="account"><?= lang('account_name'); ?></label>
                                    <select name="account" class="form-control" id="account">
                                        <?php foreach ($accounts as $account) {?>
                                            <option value="<?php echo $account->accounts_name ?>"><?php echo $account->accounts_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="income-date"><?= lang('date'); ?></label>
                                    <div class='input-group date' id='date'>
                                        <input type='text' name="income-date" id="income-date" class="form-control" autocomplete="off">
                                        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="income-type"><?= lang('income_type'); ?></label>
                                    <select name="income-type" class="form-control" id="income-type">
                                        <?php foreach ($category as $cat) {?>
                                            <option value="<?php echo $cat->accounts_name ?>"><?php echo $cat->accounts_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="amount"><?= lang('amount'); ?></label>
                                    <div class='input-group date'>
                                        <div class="input-group-addon">$</div>
                                        <input type='text' name="amount" id="amount" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="payer"><?= lang('payer'); ?></label>
                                    <select name="payer" class="form-control" id="payer">
                                        <?php foreach ($payers as $p) {?>
                                            <option value="<?php echo $p->payee_payers ?>"><?php echo $p->payee_payers ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="p-method"><?= lang('payment_method'); ?></label>
                                    <select name="p-method" class="form-control" id="p-method">
                                        <?php foreach ($p_method as $method) {?>
                                            <option value="<?php echo $method->p_method_name ?>"><?php echo $method->p_method_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

<!--                                <div class="form-group">-->
<!--                                    <label for="reference">Reference No</label>-->
<!--                                    <input type="text" class="form-control" name="reference" id="reference">-->
<!--                                </div>-->

                                <div class="form-group">
                                    <label for="note"><?= lang('note'); ?></label>
                                    <input type="text" class="form-control" name="note" id="note">
                                </div>


                                <button type="submit"  class="mybtn btn-submit"><i class="fa fa-check"></i> <?= lang('save'); ?></button>
                            </form>
                        </div>
                        <!--End Panel Body-->
                    </div>
                    <!--End Panel-->
                </div>


                <div class="col-md-7 col-lg-7 col-sm-7">
                    <!--Start Panel-->
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Deposit</div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-condensed income-table">
                                <th><?= lang('description'); ?></th><th class="text-right"><?= lang('amount'); ?></th>
                                <?php foreach($t_data as $t) {?>
                                    <tr>
                                        <td><?php echo $t->note ?></td>
                                        <td class="text-right"><?php echo get_current_setting('currency_code')." ".$t->amount ?></td>
                                    </tr>

                                <?php } ?>

                            </table>
                        </div>
                        <!--End Panel Body-->
                    </div>
                    <!--End Panel-->
                </div>


            </div><!--End Inner container-->
        </div><!--End Row-->
    </div><!--End Main-content DIV-->
</section><!--End Main-content Section-->


<script>
    $(document).ready(function() {
       $('.asyn-income').addClass('active-menu');

       $('#account').select2();
        $("#payer").select2();
        $("#income-type").select2();
        $("#p-method").select2();
        $("#date").datepicker();

        $('#amount').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
                (event.which < 48 || event.which > 57)) { event.preventDefault();
            }
        });

        $('#add-income').on('submit', function(e) {
            $.ajax({
                method: "POST",
                url: "<?= site_url('acc_admin/addIncome/insert'); ?>",
                data: $(this).serialize(),
                beforeSend: function() {
                    $(".block-ui").css('display','block');
                },
                success: function(data) {
                    if (data == "true")
                    {
                        sucessAlert("Saved Sucessfully");
                        $(".block-ui").css('display','none');
                        appendRow();
                        $('#add-income')[0].reset();
                        $('#account').select2("val", "");
                        $("#payer").select2("val", "");
                        $("#income-type").select2("val", "");
                        $("#p-method").select2("val", "");
                    } else {
                        failedAlert2(data);
                        $(".block-ui").css('display','none');
                    }
                },
            });
           return false;
        });

        function appendRow() {
            var currency="<?php echo get_current_setting('currency_code') ?>";
            $(".income-table tr:first").after("<tr><td>"+$("#note").val()+"</td><td class='text-right'>"+currency+" "+$("#amount").val()+"</td></tr>");
        }
    });
</script>