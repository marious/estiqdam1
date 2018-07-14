<div class="container">
    <div class="col-md-3 visible-sm visible-lg visible-md">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>

    <div class="col-md-9 building-container">
    <h2>قائمة التفضيلات <i class="fa fa-heart"></i></h2>
        <hr>
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>
    <?php if ($favorites && count($favorites)): ?>

        <?php foreach ($favorites as $worker): ?>
                    <div class="col-sm-4 building-item">
                        <article class="col-item">
                            <div class="photo">
                                <a href="maidinfo.html"> <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" class="img-responsive" alt="Product Image"> </a>
                            </div>
                            <div class="info">
                                <h1><?= $worker->first_name; ?> - <?= $worker->job; ?></h1>
                                <div class="price-details col-md-6">
                                    <p class="details">

                                    </p>
                                    <div>
                                        <span class="pull-right">السن : <?= calculate_age($worker->date_of_birth) ?></span>
                                        <span class="pull-left">الديانة: <?= $worker->religion; ?></span>
                                    </div>

                                </div>
                                <div class="separator clear-left">
                                    <p class="btn-desc">
                                        <a href="<?= site_url('home/maidinfo/' . str_replace(' ', '_', $worker->first_name )) ?>" class="hidden-sm details-btn"> التفاصيل<i class="fa fa-eye" style="color: #fff;"></i></a>
                                    </p>
                                </div>
                                <br>
                                <a href="<?= site_url('home/remove_from_fav/' . $worker->id); ?>" class="btn btn-block btn-danger btn-lg">مسح من المفضلة <i class="fa fa-trash" style="color: #fff;"></i></a>
                            </div>
                        </article>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>
    </div>

</div>
<div class="col-md-3 visible-xs">
    <?php $this->load->view('_includes/sidebar'); ?>
</div>
</div>