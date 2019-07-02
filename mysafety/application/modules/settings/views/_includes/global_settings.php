<form class="form-horizontal" action="<?= site_url('settings/add'); ?>" method="post" enctype="multipart/form-data">
    <div class="box box-info">
      <div class="box-body">
        
          <div class="col-md-5">
          <!-- EN Website title -->
            <div class="form-group">
              <label for="en_website_title"><?= lang('en_website_title') ?></label>
              <input type="text" class="form-control" name="en_website_title" id="en_website_title" value="<?= setting('en_website_title') ?>">
            </div>

            <!-- EN meta description -->
            <div class="form-group">
              <label for="en_meta_description"><?= lang('en_meta_description'); ?></label>
              <textarea name="en_meta_description" id="en_meta_description" rows="5" class="form-control"><?= setting('en_meta_description'); ?></textarea>
            </div>

             <!-- EN meta keywords -->
            <div class="form-group">
              <label for="en_meta_keywords"><?= lang('en_meta_keywords') ?></label>
              <input type="text" class="form-control" id="en_meta_keywords" name="en_meta_keywords" value="<?= setting('en_meta_keywords') ?>">
            </div>

            
          </div>

         
          <div class="col-md-5 col-md-push-1">
          <!-- AR Website title -->
          <div class="form-group">
              <label for="ar_website_title"><?= lang('ar_website_title') ?></label>
              <input type="text" class="form-control" name="ar_website_title" id="ar_website_title" value="<?= setting('ar_website_title') ?>">
            </div>

          <!-- AR meta description -->
          <div class="form-group">
              <label for="ar_meta_description"><?= lang('ar_meta_description'); ?></label>
              <textarea name="ar_meta_description" id="ar_meta_description" rows="5" class="form-control"><?= setting('ar_meta_description'); ?>
</textarea>
            </div>


             <!-- AR meta keywords -->
             <div class="form-group">
              <label for="ar_meta_keywords"><?= lang('ar_meta_keywords') ?></label>
              <input type="text" class="form-control" id="ar_meta_keywords" name="ar_meta_keywords"  value="<?= setting('ar_meta_keywords') ?>">
            </div>
          </div>
      </div>
      
    </div>


    <div class="">
    <button type="submit" class="btn btn-success"><?= lang('save'); ?></button>
    </div>
    
</form>        