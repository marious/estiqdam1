<div class="container">
    <div class="col-md-3 visible-sm visible-lg visible-md">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
    <div class="col-md-9">
        <?php if ($workers && count($workers)): ?>
            <?php
            $number_of_columns = 3;
            $chunk_array = array_chunk($workers, $number_of_columns);
            ?>
            <?php foreach ($chunk_array as $items): ?>
            <div class="col-md-12 building-container">
                <?php foreach ($items as $worker): ?>
                    <div class="col-sm-4 building-item">
                        <article class="col-item">
                            <div class="photo">
                                <a href="<?= site_url('home/maidinfo/' . url_title($worker->worker_id )) . '.html'; ?>">
                                    <div style="width: 100%; height: 350px; overflow: hidden;">
                                        <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" class="img-responsive" alt="Product Image" style="height: 400px;">
                                    </div>
                                </a>
                            </div>
                            <div class="info">
                                <?php
                                $job_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'job_english' : 'job';
                                ?>
                                <h1><?= $worker->$job_lang; ?> - <?= $worker->worker_id; ?></h1>
                                <div class="price-details col-md-6">
                                    <p class="details">

                                    </p>
                                    <div>
                                        <span class="pull-right"><?= lang('age'); ?> : <?= calculate_age($worker->date_of_birth) ?></span>
                                        <?php $religion = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'english_religion' : 'religion'; ?>
                                        <span class="pull-left"><?= lang('religion'); ?>: <?= $worker->$religion; ?></span>
                                    </div>

                                </div>
                                <div class="separator clear-left">
                                    <p class="btn-desc">
                                        <a href="<?= site_url('home/maidinfo/' . url_title($worker->worker_id)) . '.html'; ?>" class="hidden-sm details-btn"> <?= lang('details'); ?><i class="fa fa-eye" style="color: #fff;"></i></a>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>



        <?php if (isset($accepted_workers) && count($accepted_workers)): ?>
            <?php
            $number_of_columns = 3;
            $chunk_array = array_chunk($accepted_workers, $number_of_columns);
            ?>
            <?php foreach ($chunk_array as $items): ?>
                <div class="col-md-12 building-container">
                    <?php foreach ($items as $worker): ?>
                        <div class="col-sm-4 building-item">
                            <article class="col-item">
                                <div class="photo">
                                    <a href="<?= site_url('home/selected_maidinfo/' . url_title($worker->worker_id )) . '.html'; ?>">
                                        <div class="img-bar">
                                            <div class="shape-text">اٌختيرت</div>
                                        </div>
                                        <div style="width: 100%;height: 350px;overflow: hidden;">
                                            <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" class="img-responsive" alt="Product Image" style="height: 400px;">
                                        </div>
                                    </a>
                                </div>
                                <div class="info">
                                    <?php
                                    $job_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'job_english' : 'job';
                                    ?>
                                    <h1><?= $worker->$job_lang; ?> - <?= $worker->worker_id; ?></h1>
                                    <div class="price-details col-md-6">
                                        <p class="details">

                                        </p>
                                        <div>
                                            <span class="pull-right"><?= lang('age'); ?> : <?= calculate_age($worker->date_of_birth) ?></span>
                                            <?php $religion = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'english_religion' : 'religion'; ?>
                                            <span class="pull-left"><?= lang('religion'); ?>: <?= $worker->$religion; ?></span>
                                        </div>

                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-desc">
                                            <a href="<?= site_url('home/selected_maidinfo/' . url_title($worker->worker_id)) . '.html'; ?>" class="hidden-sm details-btn"> <?= lang('details'); ?><i class="fa fa-eye" style="color: #fff;"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>








            <?php else: ?>
            <?php
                if (isset($country) && $country == true) {
                    echo '<div class="col-md-9 building-container">';
                    echo '<h2>عذرا قريبا سيتم توفير عمالة من هذه الدولة</h2>';
                    echo '</div>';
                }
                else if (isset($search) && $search == true) {
                    echo '<div class="col-md-9 building-container">';
                    echo '<h2>عذرا لا تتوفر نتائج لهذا البحث</h2>';
                    echo '</div>';
                }
            ?>
        <?php endif; ?>
    </div>
<div class="col-md-3 visible-xs">
    <?php $this->load->view('_includes/sidebar'); ?>
</div>
</div>