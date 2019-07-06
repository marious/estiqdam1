<div class="inner-banner">
    <div class="container">
        <h1><?= transText($product->name, get_current_front_lang()) ?></h1>
    </div>
</div>

<section class="campaigns-section">
    <div class="container">
        <h2><?= transText($product->name, get_current_front_lang()) ?></h2>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="detail-page">
                    <img src="<?= site_url($product->image) ?>" alt="<?= transText($product->name, get_current_front_lang()) ?>" class="center-image">
                    <hr>
                    <p>
                        <?= transText($product->description, get_current_front_lang()) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="row gallery">

            <?php
            $this->load->module('products');
            $product_images = $this->products->Product_model->product_images($product->id);
            ?>

            <?php if (is_array($product_images) && count($product_images)): ?>
            <?php foreach ($product_images as $product_image): ?>
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <div class="frame">
                        <img src="<?= site_url($product_image->image) ?>" alt="img" class="product-img">
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>