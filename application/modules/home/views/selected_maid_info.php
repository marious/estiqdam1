<div class="container">
    <div class="col-md-3 visible-sm visible-lg visible-md">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
    <?php
    $this->load->module('home');
    $this->load->module('worker_nationality');
    $nationality = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'nationality_in_english' : 'nationality_in_arabic';
    $nationality = $this->worker_nationality->Worker_nationality_model->get($worker->nationality_id, true)->$nationality;
    ?>

    <div class="col-md-9 building-container">


        <div class="profile-content">
            <?php
            $job_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'job_english' : 'job';
            ?>
            <h1><?= $worker->$job_lang; ?> : <?= $worker->id; ?></h1>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <div style="overflow: hidden; width: 100%; height: 350px;">
                        <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" alt="<?php echo "عاملة منزلية رقم {$worker->id}";  ?>" class="img-responsive maid-img" data-pic-title="Image 1"
                             data-pic-desc="Descript 1" data-pic="<?= site_url('assets/img/workers/' . $worker->image); ?>" style="height: 500px;">
                    </div>
                    <br>
                    <div class="contact-us">
                        <a href="tel:0541566633" title="0541566633"> <i class="fa fa-mobile"></i> 0541566633</a>
                        <a href="tel:0547830004" title="0547830004"> <i class="fa fa-mobile"></i> 0547830004</a>
                    </div>

                    <div class="share-buttons">
                        <a href="https://api.whatsapp.com/send?phone=966541566633" class="btn btn-block whatsapp-share" target="_blank">تواصل واتس <i class="fa fa-whatsapp white"></i></a>
                        <a href="whatsapp://send?text=<?= urlencode('مكتب السلام للاستقدام') ?> http://peace4r.com/home/maidinfo/<?=  url_title($worker->first_name); ?>" data-action="share/whatsapp/share" class="btn btn-block whatsapp-share" target="_blank">مشاركة بالواتس <i class="fa fa-whatsapp white"></i></a>
                        <a href="https://twitter.com/share?url=http://peace4r.com/home/maidinfo/<?= url_title($worker->first_name); ?>&amp;text=عاملة منزلية من <?=  $nationality; ?> مكتب السلام للاستقدام &amp;hashtags=السلام_للاستقدام" class="twitter-share btn btn-block" target="_blank">Tweet <i class="fa fa-twitter white"></i></a>
                        <a href="http://www.facebook.com/sharer.php?u=http://peace4r.com/home/maidinfo/<?= url_title($worker->first_name) ?> . '.html'" class="facebook-share btn-block btn" target="_blank">Share <i class="fa fa-facebook-official white"></i></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped table-bordered maid-info-table">
                        <tr>
                            <th><?= lang('name');  ?></th>
                            <td><?= $worker->name; ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('age');  ?></th>
                            <td><?= calculate_age($worker->date_of_birth); ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('salary');  ?></th>
                            <td><?= format_money('sa-SA', $worker->salary); ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('religion');  ?></th>
                            <?php $religion = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? $worker->english_religion : $worker->religion ?>
                            <td><?= $religion; ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('job');  ?></th>
                            <?php $job = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? $worker->job_english : $worker->job; ?>
                            <td><?= $job; ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('nationality');  ?></th>
                            <td>
                                <?php
                                echo $nationality;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('marital_status');  ?></th>
                            <td>
                                <?php
                                $single = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'Single' : 'أعزب';
                                $married = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'Married' : 'متزوج';
                                ?>
                                <?php echo ($worker->marital_status == 1) ? $single : $married; ?>
                            </td>
                        </tr>

                        <tr>
                            <th><?= lang('english_language');  ?></th>
                            <td>
                                <?php if ($worker->english_language == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('arabic_language');  ?></th>
                            <td>
                                <?php if ($worker->arabic_language == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('cleaning');  ?></th>
                            <td>
                                <?php if ($worker->cleaning == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('ironing');  ?></th>
                            <td>
                                <?php if ($worker->ironing == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('cooking');  ?></th>
                            <td>
                                <?php if ($worker->cooking == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('child_care');  ?></th>
                            <td>
                                <?php if ($worker->baby_sitting == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('old_care');  ?></th>
                            <td>
                                <?php if ($worker->old_care == '0'): ?>
                                    <i class="fa fa-remove fa-lg red-color"></i>
                                <?php else: ?>
                                    <i class="fa fa-check fa-lg"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('experience_period'); ?></th>
                            <td><?= $worker->experience_period ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('experience_country'); ?></th>
                            <td><?= $worker->experience_country ?></td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>


        <div class="text-center">
        </div>
    </div>

    <div class="col-md-3 visible-xs">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>

</div>