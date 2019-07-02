<div class="inner-banner">
    <div class="container">
        <h1><?= lang('news') ?></h1>
    </div>
</div>

<section class="blog">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				
				<!-- Blog Classic Start -->
				<div class="blog-grid">
					<div class="row">
						<div class="col-md-12">
            

              <?php if (is_array($news) && count($news)): ?>
              <?php foreach ($news as $row): ?>
								<div class="post-item">
									<div class="image-holder">
										<img class="img-responsive" src="<?= site_url($row->image) ?>" alt="<?= transText($row->name, get_current_front_lang()) ?>">
									</div>
									<div class="text">
										<h3><a href="<?= site_url('news/item/' .transText($row->slug, 'en')) ?>"><?= transText($row->name, get_current_front_lang()) ?></a></h3>
										<ul class="status">
											<li> <i class="fa fa-calendar"></i> <?= lang('date') ?> <?= date('n, Y', strtotime($row->created_at)) ?></li>
										</ul>
                    <p>

                      <?= shortDescrip(transText($row->description, get_current_front_lang()), 60) ?>

                    </p>
										<p class="button">
											<a href="<?= site_url('news/item/' .transText($row->slug, 'en')) ?>"><?= lang('read_more') ?></a>
										</p>
									</div>
                </div>
<?php endforeach; ?>
<?php endif; ?>
							
							 
		
							
						</div>

						<div class="col-md-12">
              <?=$pagination;?>
            </div>

					</div>
				</div>
				<!-- Blog Classic End -->

			</div>
			<div class="col-md-3">
				
				<!-- Sidebar Container Start -->
<div class="sidebar">

	<div class="widget">
        <?php
            $this->load->module('categories');
            $categories = $this->categories->Category_model->get();
        ?>
				<h4><?= lang('categories') ?></h4>
        <?php if (is_array($categories) && count($categories)): ?>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li><a href="<?= site_url('categories/item/' . transText($category->slug, 'en')) ?>"><?= transText($category->name, get_current_front_lang()) ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
	</div>

</div>
<!-- Sidebar Container End -->			
			</div>

			


		</div>
	</div>
</section>