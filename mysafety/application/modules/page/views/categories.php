<div class="inner-banner">
    <div class="container">
        <h1><?= lang('categories') ?></h1>
    </div>
</div>

<section class="service-v1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2><?=  lang('our_categories') ?></h2>
                    <p><?= lang('check_our_categories') ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if (is_array($categories) && count($categories)) {
                foreach ($categories as $category) {
                    ?>
                    <div class="col-sm-6 col-md-4 ser-item wow fadeInUp">
                        <div class="item">
                            <div class="photo" style="background-image:url(<?php echo site_url($category->image); ?>);">
                            </div>
                            <div class="text">
                                <h3><a href="<?= site_url('categories/item/' . transText($category->slug, get_current_front_lang())); ?>"><?php echo transText($category->name, get_current_front_lang()); ?></a></h3>
                                <p>
                                    <?php echo shortDescrip(transText($category->description, get_current_front_lang()), 50) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>