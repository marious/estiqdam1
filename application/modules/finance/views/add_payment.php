<section>

    <div class="panel panel-default m-t">
        <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> Contracts</div>
        <div class="panel-body">
            <div class="tab-content m-t">

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>


                <table id="services_table" class="table table-bordered table-striped services-table">
                    <thead>
                    <tr>
                        <th>اسم العميل</th>
                        <th>الجوال</th>
                        <th>اجمالى المبلغ</th>
                        <th>المبلغ المدفوع</th>
                        <th>المبلغ المتبقى</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td><?= $customer->customer_name_in_arabic; ?></td>
                        <td><?= $customer->customer_mobile; ?></td>
                        <td><?= $finance->recruitment_cost; ?></td>
                        <td><?= $finance->prepaid_money; ?></td>
                        <td><?= $finance->remains_money; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper" id="paid_customer">
        <div class="block-content">
            <div class="panel panel-default m-t">
                <div class="panel-heading"><span class="glyphicon"></span> Customer Payment</div>
                <div class="panel-body">
                    <div class="tab-content m-t services-entry-form">
                        <div class="row">
                            <form action="<?= site_url('finance/save_payment') ?>" method="post">
                                <div class="col-md-4">
                                    <label for="paid_money">المبلغ المدفوع<span class="enter-keyword"></span></label>
                                    <input type="text" class="form-control" name="paid_money" required>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    $this->load->module('transfer_types');
                                    $transfer_types = $this->transfer_types->Transfer_type_model->get();
                                    ?>
                                    <label for="transfer_type">نوع التحويل</label>
                                    <select id="transfer_type" class="form-control" name="transfer_type">
                                        <option value="0">-- SELECT --</option>
                                        <?php if ($transfer_types && count($transfer_types)): ?>
                                            <?php foreach ($transfer_types as $type): ?>
                                                <?php
                                            $category_type = '';
                                                if ($type->parent_id != 0)
                                                {
                                                    $category_type = ' - ' . $this->transfer_types->get_type_by_id($type->parent_id) ;
                                                }
                                                ?>
                                                <option value="<?= $type->id; ?>"><?= $type->type . ' ' . $category_type; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="contract_number" value="<?= $customer->contract_number; ?>">
                                    <input type="hidden" name="customer_name_in_arabic" value="<?= $customer->customer_name_in_arabic; ?>">
                                    <label for="">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block"><?= lang('save') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>