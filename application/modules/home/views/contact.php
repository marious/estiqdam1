<div class="container">
    <div class="col-md-3">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
    <div class="col-md-9 building-container">

        <h1 class="contact-us"><?= lang('contact_us'); ?></h1>
        <hr>

        <dic class="colmd-12">
            <div class="contact-info">
                <h3><?= lang('info_contact_office'); ?> <br>
                </h3>
                <p>حائل حى النقرة - شارع اﻻمير سعود الشريان</p>
                <div class="">
                    <div><i class="fa fa-mobile fa-lg"></i> 0541566633</div>
                    <div><i class="fa fa-mobile fa-lg"></i> 0547830004</div>
                </div>

                <!-- Map Here -->
            </div>

        </dic>

           <div class="col-md-12">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14157.802513692352!2d41.66932640505685!3d27.486357681846286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x40c3259e448a6fac!2z2YXZg9iq2Kgg2KfZhNiz2YTYp9mFINmE2YTYp9iz2KrZgtiv2KfZhSBQZWFjZSBGb3IgUmVjcnVpdG1lbnQgb2ZmaWNl!5e0!3m2!1sen!2suk!4v1514143991378" style="width: 100%;" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
           </div>

        <div class="clearfix"></div>

        <form action="<?= site_url('home/contact'); ?>" class="form-horizontal" method="post">

           <?php if ($this->session->flashdata('error_message')): ?>
               <div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <?php echo $this->session->flashdata('error_message'); ?>
               </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="name" class="control-label col-md-2"><?= lang('name'); ?> : </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" maxlength="100" id="name" value="<?= set_value('name'); ?>">
                    <?= form_error('name'); ?>
                </div>
            </div><!-- ./ form-group -->

            <div class="form-group">
                <label for="mobile_number" class="control-label col-md-2" style="font-size: 14px;"><?= lang('mobile_number'); ?> :</label>
                <div class="col-md-6">
                    <input type="tel" class="form-control" name="mobile_number" id="mobile_number" value="<?= set_value('mobile_number') ?>">
                    <?= form_error('mobile_number') ?>
                </div>
            </div><!-- ./ form-group -->

            <div class="form-group">
                <label for="message" class="control-label col-md-2"><?= lang('message'); ?> : </label>
                <div class="col-md-6">
                    <textarea name="message" id="message" cols="30" rows="4" class="form-control">
                        <?= set_value('message'); ?>
                    </textarea>
                    <?= form_error('message'); ?>
                </div>
            </div><!-- ./ form-group -->

            <div class="col-md-5 col-md-push-2">
                <?php echo $cicaptcha_html; ?>
            </div>
            <div class="clearfix"></div>

            <br>
            <div class="form-group">
                <div class="col-md-6 col-md-push-2">
                    <button class="btn btn-success btn-block">أرسل</button>
                </div>
            </div>


        </form>




        <div class="text-center">
        </div>
    </div>
</div>