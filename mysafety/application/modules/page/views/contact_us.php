<div class="inner-banner">
    <div class="container">
        <h1><?= lang('contact_us') ?></h1>
    </div>
</div>

<section class="contact-section">
    <div class="container">
        <h2></h2>
        <form action="<?= site_url('contacts/add') ?>" method="post">

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= lang('success_contact_message') ?></div>
            <?php endif; ?>
            <?php
            if ( $this->session->flashdata('errors')) {
                $errors = $this->session->flashdata('errors');

            }
            ?>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <label for="name"><?= lang('name'); ?></label>
                    <input type="text" placeholder="<?= lang('enter_name') ?>" required id="name" name="name">
                    <?php if (isset($errors) && $errors['name']) echo '<div class="error">' . $errors['name'] . '</div>'; ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="email"><?=lang('email')?></label>
                    <input type="email" placeholder="<?=lang('enter_email')?>" required id="email" name="email">
                    <?php if (isset($errors) && $errors['email']) echo '<div class="error">' . $errors['email'] . '</div>'; ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="contact-phone"><?=lang('contact_phone')?></label>
                    <input type="text" placeholder="<?=lang('enter_contact_phone')?>" required id="contact-phone" name="phone" autocomplete="off">
                    <?php if (isset($errors) && $errors['phone']) echo '<div class="error">' . $errors['phone'] . '</div>'; ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="subject"><?=lang('subject')?></label>
                    <input type="text" placeholder="<?= lang('enter_subject') ?>" required id="subject" autocomplete="off" name="subject">
                    <?php if (isset($errors) && $errors['subject']) echo '<div class="error">' . $errors['subject'] . '</div>'; ?>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label for="message"><?= lang('message') ?></label>
                    <textarea required placeholder="<?= lang('enter_message') ?>" cols="10" rows="10" id="message" name="message"></textarea>
                    <?php if (isset($errors) && $errors['message']) echo '<div class="error">' . $errors['message'] . '</div>'; ?>
                </div>
                <div class="col-md-12">
                    <input type="submit" value="<?= lang('get_contact') ?>">
                </div>
            </div>
        </form>
    </div>
</section>

<div class="clearfix"></div>
<!-- Contact Section -->
<section class="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="map-box">
                    <?= setting('contact_map_iframe') ?>
                </div>
            </div>
            <div class="col-md-3 col-md-push-1">
                <h2><?= lang('contact_us') ?></h2>
                <ul>
                    <li>
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <div class="text-col">
                            <span><?= lang('main_head_office') ?>:</span>
                            <strong><?php echo get_current_front_lang() == 'ar' ? setting('ar_contact_address') : setting('en_contact_address');  ?></strong>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div class="text-col">
                            <span><?= lang('head_branch') ?>:</span>
                            <strong class="ltr"><?= setting('contact_phone') ?></strong>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <div class="text-col">
                            <span><?= lang('email_inquiry') ?>:</span>
                            <a href="mailto:setting('contact_email')">
                            <span class="__cf_email__">
                                <?= setting('contact_email') ?>
                            </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- End contact Sesion -->
