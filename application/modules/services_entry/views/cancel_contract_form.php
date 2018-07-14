<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('cancel_contract'); ?></h3>
                </div>

                <br>
                <div class="page-body">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('services_entry/cancel_contract/' . $contract_number); ?>" method="post">
                        <div class="form-group">
                            <label for="">السبب</label>
                            <textarea name="reason" id="" cols="30" rows="5" class="form-control"></textarea>
                            <?= form_error('reason'); ?>
                        </div>
                        <input type="hidden" name="contract_number" value="<?= $contract_number; ?>">
                        <div class="form-group">
                            <button class="btn btn-default btn-block">الغاء</button>
                        </div>
                    </form>
                </div>



            </div>
        </div>
</section>
