<div class="container">
    <div class="col-md-3 visible-sm visible-lg visible-md">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
    <div class="col-md-9">

                <div class="col-md-12 building-container">
                    <div class="col-md-6 col-md-push-2">
                        <div class="share-buttons">
                            <a href="https://api.whatsapp.com/send?phone=966541566633" class="btn btn-block whatsapp-share" target="_blank">تواصل واتس <i class="fa fa-whatsapp white"></i></a>
                            <a href="https://twitter.com/share?url=http://peace4r.com/home/seo_pages/<?= url_title($seo_page->title); ?>&amp;hashtags=السلام_للاستقدام" class="twitter-share btn btn-block" target="_blank">Tweet <i class="fa fa-twitter white"></i></a>
                            <a href="http://www.facebook.com/sharer.php?u=http://peace4r.com/home/seo_pages/<?= url_title($seo_page->title) ?>" class="facebook-share btn-block btn" target="_blank">Share <i class="fa fa-facebook-official white"></i></a>
                        </div>
                    </div>
                    <article style="color: #fff;"><?= $seo_page->content; ?></article>
                </div>


    </div>
    <div class="col-md-3 visible-xs">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
</div>