<div class="inner-banner">
    <div class="container">
        <h1><?= transText($page->name, get_current_front_lang()) ?></h1>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= transText($page->name, get_current_front_lang()) ?></h2>
                <hr>
                <?= transText($page->content, get_current_front_lang());?>
            </div>
        </div>
    </div>
</section>
