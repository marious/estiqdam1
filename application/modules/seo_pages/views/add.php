<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">SEO Pages / <?php echo (null == $id) ? 'Add New' : 'Edit'; ?> SEO Page</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="<?= base_url() . 'seo_pages'; ?>">SEO Pages</a>
                            </li>
                            <li class="<?php echo (null == $id) ? 'active' : ''; ?>">
                                <a href="<?php echo (null == $id) ? '' : site_url('seo_pages/add'); ?>">Add New</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plane"></span> SEO Pages</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">


                                    <form action="" class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="name_in_english" class="control-label col-md-3">Title</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'title',
                                                        'class'         => 'form-control',
                                                        'id'            => 'title',
                                                        'value'         => set_value('title', $seo_page->title),
                                                        'placeholder'   => 'Title',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?php echo form_error('title'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="name_in_arabic" class="control-label col-md-3">Content</label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'content',
                                                        'class'         => 'form-control',
                                                        'id'            => 'editor',
                                                        'value'         => $seo_page->content,
                                                        'placeholder'   => 'Content',
                                                    ];
                                                    ?>
                                                        <?= form_textarea($data); ?>
                                                    <?php echo form_error('name_in_arabic'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->


                                            <div class="box-footer">
                                                <div class="col-md-6 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                                </div>
                                            </div>


                                        </fieldset>
                                        <!--                                   </div>-->
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div>
    </div>
</section>