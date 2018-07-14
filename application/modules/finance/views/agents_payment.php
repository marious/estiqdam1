<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Agents Payment</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Agents Payment</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <table id="agents-payment" class="table table-bordered table-striped services-table accepted-table-2">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="15%">اسم العامل</th>
                                            <th width="5%">
                                                <select name="agent" id="agent">
                                                    <option value="">كل المكاتب</option>
                                                    <?php foreach ($agents as $agent): ?>
                                                        <option value="<?= $agent->id; ?>"><?=$agent->username; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </th>
                                            <th width="13%">العميل</th>
                                            <th width="7%">تاريخ الوصول</th>
                                            <th width="9%">حالة الدفع</th>
                                            <th width="8%">إجمالى العمولة</th>
                                            <th width="8%">الدفعة الاولى</th>
                                            <th width="8%">الدفعة الثانية</th>
                                            <th width="8%">المتبقى</th>
                                            <th>ملاحظات</th>
                                        </tr>
                                        </thead>

                                    </table>
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



<div id="noteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="change_title">عمل ملاحظة</span></h4>
            </div>
            <div class="modal-body">
                <p>الملاحظة
                    <textarea  name="note" id="note" class="form-control"></textarea></p>
                <br />
                <input type="hidden" name="contract_number" id="contract-number" />
                <input type="button" name="folder_button" id="note-button" class="btn btn-info btn-block" value="حفظ" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div id="payment-modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="payment-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">عمولة المكتب الاجنبى</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group" style="margin-bottom: 40px;">
                        <label for="total_payment" class="control-label col-md-5">إجمالى العمولة</label>
                        <div class="col-md-7 col-md-push-1">
                            <input type="text" name="total_payment"  id="total_payment"
                                   value="<?php echo set_value('total_payment'); ?>">
                            <div><?php echo form_error('total_payment') ?></div>
                        </div>
                    </div>

                    <br>

                    <div class="form-group" style="margin-bottom: 40px;">
                        <label for="total_payment" class="control-label col-md-5">الدفعة الاولى</label>
                        <div class="col-md-7 col-md-push-1">
                            <input type="text" name="first_payment"  id="first_payment"
                                   value="<?php echo set_value('first_payment'); ?>">
                            <div><?php echo form_error('first_payment') ?></div>
                        </div>
                    </div>

                    <br>

                    <div class="form-group" style="margin-bottom: 40px;">
                        <label for="total_payment" class="control-label col-md-5">الدفعة الثانية</label>
                        <div class="col-md-7 col-md-push-1">
                            <input type="text" name="second_payment"  id="second_payment"
                                   value="<?php echo set_value('second_payment'); ?>">
                            <div><?php echo form_error('second_payment') ?></div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <input type="hidden" name="contract_number" id="contract_number" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Update" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>