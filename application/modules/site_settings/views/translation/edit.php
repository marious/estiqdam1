<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('site_settings'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="<?= base_url() . 'site_settings'; ?>"><?= lang('institution_details'); ?></a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'site_settings/site_logo'; ?>">Site Logo</a>
                            </li>
                            <li class="active">
                                <a href="<?= base_url() . 'site_settings/get_translation'; ?>">Translation</a>
                            </li>
                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><?= lang('language_settings'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <div class="sbox-title"><h4> Languange Manager </h4></div>

                                    <div class="sbox-content">
                                        <div class="table-responsive box" style="padding:5px;">
                                            <ul class="nav nav-tabs">
                                                <?php
                                                $not_wanted_fiels = array(
                                                    'calendar_lang.php',
                                                    'date_lang.php', 'db_lang.php', 'email_lang.php',
                                                    'form_validation_lang.php', 'ftp_lang.php',
                                                    'imglib_lang.php', 'migration_lang.php', 'number_lang.php',
                                                    'pagination_lang.php', 'profiler_lang.php', 'unit_test_lang.php',
                                                    'upload_lang.php',
                                                );
                                                ?>
                                                <?php foreach($files as $f): ?>
                                                    <?php if($f != "." and $f != ".." and $f != 'info.json' && $f != 'index.html'
                                                        && !in_array($f, $not_wanted_fiels)) : ?>
                                                        <li <?php if($file == $f) echo 'class="active"' ?> ><br>

                                                            <a href="<?php echo site_url('site_settings/get_translation_edit?edit='.$lang.'&file='.$f) ?>"><?php echo $f ?> </a></li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                            <hr />
                                            <?php echo form_open('site_settings/post_save_translation/add') ?>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th> Pharse </th>
                                                    <th> Translation </th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                foreach($string_lang as $key => $val) :
                                                    if(!is_array($val))
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $key ;?></td>
                                                            <td><input type="text" name="<?php echo $key ;?>" value="<?php echo $val ;?>" class="form-control" />

                                                            </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        foreach($val as $k=>$v)
                                                        { ?>
                                                            <tr>
                                                                <td><?php echo $key .' - '.$k ;?></td>
                                                                <td><input type="text" name="<?php echo $key ;?>[<?php echo $k ;?>]" value="<?php echo $v ;?>" class="form-control" />

                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                endforeach; ?>
                                                </tbody>

                                            </table>
                                            <input type="hidden" name="lang" value="<?php echo $lang ?>"  />
                                            <input type="hidden" name="file" value="<?php echo $file ?>"  />
                                            <button type="submit" class="btn btn-primary"> Save Translation</button>
                                            <?php echo form_close() ?>

                                        </div>
                                    </div>

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