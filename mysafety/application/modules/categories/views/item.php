<div class="inner-banner">
    <div class="container">
        <h1></h1>
    </div>
</div>

<section class="campaigns-section">
    <div class="container">
        <h2><?= transText($category->name, get_current_front_lang()) ?></h2>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="detail-page">
                    <img src="<?= site_url($category->image); ?>" alt="<?= transText($category->name, get_current_front_lang()) ?>" class="center-image">

                    <hr>

                    <p><?= transText($category->description, get_current_front_lang()); ?></p>

                    <hr>

                    <div class="row">
                        <h3><b><?= lang('products_of_category') ?></b></h3>
                        <?php
                        $this->load->module('products');
                        $products = $this->products->Product_model->get_by(['category_id' => $category->id]);
                        ?>
                        <div class="row">

                            <?php if (is_array($products) && count($products)): ?>
                                <?php foreach ($products as $product): ?>
                                    <div class="col-md-3 col-sm-6 arDir">
                                        <div class="box">
                                            <div class="frame">
                                                <a href="<?= site_url('categories/product/' . transText($product->slug, get_current_front_lang())) ?>">
                                                    <img src="<?= site_url($product->image) ?>" alt="img" height="200px;">
                                                </a>
                                            </div>
                                            <h3>
                                                <a href="<?= site_url('categories/product/' . transText($product->slug, get_current_front_lang())) ?>">
                                                    <?= transText($product->name, get_current_front_lang()) ?>
                                                </a>
                                            </h3>
                                            <p>
                                                <?= shortDescrip(transText($product->description, get_current_front_lang()), 20) ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>