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
                        <img class="img-responsive news-item-img" src="<?= site_url($offer->image) ?>" alt="<?= transText($offer->offer_heading, 'en') ?>">
                    </div>
                    <div class="text text-single">
                        <h3><?= transText($offer->offer_heading, get_current_front_lang()) ?></h3>
                        <p>
                            <?= transText($offer->offer_content, get_current_front_lang()) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>