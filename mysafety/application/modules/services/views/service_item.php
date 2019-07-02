<div class="inner-banner">
    <div class="container">
        <h1></h1>
    </div>
</div>

<section class="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="post-item">
                    <div class="image-holder image-holder-single">
                        <img class="img-responsive news-item-img" src="<?= site_url($service->image) ?>" alt="<?= transText($service->name, 'en') ?>">
                    </div>
                    <div class="text text-single">
                        <h3><?= transText($service->name, get_current_front_lang()) ?></h3>

                        <p>
                            <?= transText($service->description, get_current_front_lang()) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>