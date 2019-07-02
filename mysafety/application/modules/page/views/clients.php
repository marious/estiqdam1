<div class="inner-banner">
    <div class="container">
        <h1><?= lang('clients') ?></h1>
    </div>
</div>

<section class="gallery-section">
    <div class="container">
        <h2><?= lang('our_clients'); ?></h2>
        <div class="row gallery">

            <?php if (is_array($clients) && count($clients)): ?>
            <?php foreach ($clients as $client): ?>
            <div class="col-md-2 col-sm-2 arDir">
                <div class="frame">
                    <img src="<?= site_url($client->image) ?>" alt="<?= transText($client->name, 'en') ?>">
                    <a href="<?= site_url($client->image) ?>" class="zoom" data-rel="prettyPhoto[gallery1]" rel="prettyPhoto[gallery1]">
                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>