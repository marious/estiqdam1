<div class="container">
    <div class="col-md-3 visible-sm visible-lg visible-md">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
    <div class="col-md-9">

        <div class="col-md-12 building-container">
            <h1 class="contact-us">للتنازل</h1>
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success'); ?>
            </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="contact-info">
                   <p style="font-size: 18px;">خدمة مجانية يقدمها موقع السلام للاستقدام وهى عمل طلب مجانى للتنازل عن عاملتك المنزلية</p>
                </div>
            </div>

            <form action="<?= site_url('home/tanazul'); ?>" class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="adv_text" class="control-label col-md-2">نص الاعلان:</label>
                    <div class="col-md-8">
                        <textarea name="adv_text" id="" cols="50" rows="2" class="form-control"></textarea>
                        <?= form_error('adv_text'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile_number" class="control-label col-md-2" style="font-size: 14px;">رقم الجوال :</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="mobile_number" id="mobile_number" value="">
                        <?= form_error('mobile_number'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-push-3">
                        <button class="btn btn-success btn-block">اعلن</button>
                    </div>
                </div>
            </form>

        </div>


        <div class="col-md-12 building-container">
            <h2>طلبات التنازل الموجودة</h2>
            <table class="table table-bordered table-striped">
                <thead>
                   <tr>
                       <th width="75%">الاعلان</th>
                       <th>رقم التواصل</th>
                   </tr>
                </thead>
                <tbody>
                <?php if ($advs && count($advs)): ?>
                <?php foreach ($advs as $adv): ?>
                <tr>
                    <td><?= $adv->adv_text; ?></td>
                    <td><?= $adv->mobile_number; ?></td>
                </tr>
                <?php endforeach;  ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>


    </div>
    <div class="col-md-3 visible-xs">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
</div>