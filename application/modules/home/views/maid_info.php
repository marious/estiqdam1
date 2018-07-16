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

    <div class="col-md-10 building-container">


        <div class="profile-content">
            <?php
            $job_lang = isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english' ? 'job_english' : 'job';
            ?>
            <h1><?= $worker->$job_lang; ?> : <?= $worker->id; ?></h1>
            <hr>

            <div class="row">
                <div class="col-md-5">
                    <?php
                    $img_size = getimagesize(FCPATH . '/assets/img/workers/' . $worker->image);
                    $img_width = $img_size[0];
                    $img_height = $img_size[1];
                    ?>
                    <div style="width: 100%; height: 300px;overflow: hidden;">
                        <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" alt="" class="img-responsive maid-img" data-pic-title="Image 1"
                             data-pic-desc="Descript 1" data-pic="<?= site_url('assets/img/workers/' . $worker->image); ?>"
                        >
                    </div>
                    <br>
                    <div class="contact-us">
                        <a href="tel:508586858" title="508586858"> <i class="fa fa-mobile"></i> 508586858</a>
                    </div>
                    <?php if (isset($_SESSION['logged_in']) && isset($_SESSION['access_id']) && $_SESSION['access_id'] == 3): ?>
                        <?php if ($customer->selected_worker_id == '0'): ?>
                    <a href="<?= site_url('home/make_service/' . $_SESSION['id']) . '/'. $worker->id ?>" class="btn btn-lg btn-block btn-success">اطلب اﻻن</a>
                            <?php endif; ?>
                        <?php if (! $this->home->Site_model->check_in_customer_fav($_SESSION['id'], $worker->id)): ?>
                            <a class="btn btn-block btn-success btn-lg" href="<?= site_url('home/customer_favorite/' . $worker->id); ?>">
                         <i class="fa fa-heart" style="color: #fff;"></i>       اضف الى المفضلة
                            </a>
                            <?php  endif; ?>
                    <?php endif; ?>
                    <div class="share-buttons">
                        <?php
                        $share_text = "عاملة منزلية من $nationality جاهزة للاستقدام من مكتب السلام للاستقدام ";
                        ?>
                        <a href="https://api.whatsapp.com/send?phone=966508586858" class="btn btn-block whatsapp-share" target="_blank">تواصل واتس <i class="fa fa-whatsapp white"></i></a>
                        <a href="whatsapp://send?text=<?= urlencode('عاملة منزلية من اثيوبيا') ?> http://peace4r.com/home/maidinfo/<?=  url_title($worker->first_name); ?>" data-action="share/whatsapp/share" class="btn btn-block whatsapp-share" target="_blank">مشاركة بالواتس <i class="fa fa-whatsapp white"></i></a>
                        <a href="https://twitter.com/share?url=http://http://estgdam1.com/.com/home/maidinfo/<?= url_title($worker->first_name); ?>&amp;text=عاملة منزلية من <?=  $nationality; ?>  &amp;hashtags=" class="twitter-share btn btn-block" target="_blank">Tweet <i class="fa fa-twitter white"></i></a>
                        <a href="http://www.facebook.com/sharer.php?u=http://http://estgdam1.com/.com/home/maidinfo/<?= url_title($worker->first_name) ?> . '.html'" class="facebook-share btn-block btn" target="_blank">Share <i class="fa fa-facebook-official white"></i></a>
                    </div>
                </div>
                <div class="col-md-7">
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
                                    echo $worker->nationality_id == '21' ? ' - ' : $nationality;
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