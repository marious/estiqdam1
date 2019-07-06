<?php
$sliders = Modules::run('slider/get_all');
?>
<?php if (is_array($sliders) && count($sliders)): ?>
    <section id="mainSlider">
        <div id="owl-main" class="owl-carousel height-md owl-inner-nav owl-ui-lg">


            <?php foreach ($sliders as $slider): ?>

                <?php
                $class = '';
                $pos = '';
                if ($slider->position) {
                    $pos = strtolower($slider->position);
                    switch ($slider->position) {
                        case 'Left':
                            $class = 'fadeInLeft-1';
                            break;
                        case 'Right':
                            $class = 'fadeInRight-1';
                            break;
                        case 'Center':
                            $class = 'fadeInDown-1';
                    }
                }
                ?>


                <div class="item-slider">
                    <div class="item" style="background-image: url(<?= site_url($slider->image) ?>);">
                        <div class="container">
                            <div class="caption vertical-center text-<?= $pos; ?>">

                                <h1 class="<?=$class?> light-color"> <?= transText($slider->heading, get_current_front_lang()) ?> </h1>
                                <p class="<?=$class . '-2'?> light-color"><?= transText($slider->content, get_current_front_lang()) ?></p>
                                <div class="<?= $class . '-3'; ?>">
                                    <?php if (transText($slider->button_text, get_current_front_lang())): ?>
                                        <a href="<?= $slider->button_url; ?>" class="btn btn-large"><?= transText($slider->button_text, get_current_front_lang()) ?></a>
                                    <?php endif; ?>
                                </div><!-- /.fadeIn -->

                            </div><!-- /.caption -->
                        </div><!-- /.container -->
                    </div><!-- /.item -->
                </div>


            <?php endforeach; ?>
        </div>

    </section>

<?php endif; ?>

<!-- categories -->
<section class="categories-v1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2><?= lang('our_categories') ?></h2>
                    <p><?= lang('check_our_categories') ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="categories-carousel">
                    <?php
                    $categoreis = Modules::run('categories/get_all');
                    ?>
                    <?php if (is_array($categoreis) && count($categoreis)): ?>
                        <?php foreach ($categoreis as $category): ?>
                            <div class="item wow fadeInUp">
                                <div class="thumb">
                                    <div class="photo" style="background-image:url(<?php echo site_url($category->image) ?>);"></div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="text">
                                    <h3><a href="<?php echo site_url('categories/item/' .  transText($category->slug, get_current_front_lang()) ) ?>"><?php echo transText($category->name, get_current_front_lang()); ?></a></h3>
                                    <p><?php echo shortDescrip(transText($category->description, get_current_front_lang()), 10); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div><!-- categories-carousel -->
            </div>

        </div>

    </div>
</section>
<!-- Categories End -->

<!-- Service Start -->
<section class="service-v1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2><?=  lang('our_services') ?></h2>
                    <p><?= lang('check_our_services') ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $services = Modules::run('services/get_all');
            if (is_array($services) && count($services)) {
                foreach ($services as $service) {
                    ?>
                    <div class="col-sm-6 col-md-4 ser-item wow fadeInUp">
                        <div class="item">
                            <div class="photo" style="background-image:url(<?php echo site_url($service->image); ?>);">
                            </div>
                            <div class="text">
                                <h3><a href="<?= site_url('services/item/' . transText($service->slug, get_current_front_lang())); ?>"><?php echo transText($service->name, get_current_front_lang()); ?></a></h3>
                                <p>
                                    <?php echo shortDescrip(transText($service->description, get_current_front_lang()), 20) ?>
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
<!-- Service End -->


<!-- News Section -->

<section class="news-v1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2><?= lang('latest_news') ?></h2>
                    <p><?= lang('see_latest_news')  ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- News Carousel Start -->
                <div class="news-carousel">

                    <?php
                    $i=0;
                    $news = Modules::run('news/get_latest');
                    if (is_array($news) && count($news))
                        foreach ($news as $row) {
                            $i++;
                            if($i>20) {break;}
                            ?>
                            <div class="item wow fadeInUp">
                                <div class="thumb">
                                    <div class="photo" style="background-image:url(<?php echo site_url($row->image) ?>);"></div>
                                </div>
                                <div class="text">
                                    <h3><a href="<?php echo site_url('news/item/' . transText($row->slug, get_current_front_lang())); ?>"><?php echo transText($row->name, get_current_front_lang()); ?></a></h3>
                                    <p><?php echo shortDescrip(transText($row->description, get_current_front_lang()), 20) ?></p>
                                </div>
                            </div>
                            <?php
                        }

                    ?>

                </div>
                <!-- News Carousel End -->

            </div>
        </div>
    </div>
</section>

<!-- END News Section -->


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
                            <strong><?= setting('contact_phone') ?></strong>
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
