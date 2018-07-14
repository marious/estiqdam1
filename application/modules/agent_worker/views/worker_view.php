<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        <?php if (isset($html) && $html == true): ?>
        body {
            font-size: 16px;
        }
        h2 {
            font-size: 22px;
        }
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
        .logo {
            text-align: center;
        }
        .logo img {
            display: inline-block;
            width: 200px;
            height: 80px;
        }
        h2.center {
            text-align: center;
        }
        div.data {
            width: 550px;
            float: left;
        }
        div.personal-photo {
            width: 400px;
            float: left;
            border: 1px solid #000;
            /*margin-left: 10px;*/
            margin-top: 50px;
            padding: 5px;
        }

        div.personal-photo img {
            width: 400px;
            display: block;
        }
        table {
            border: 1px solid #000;
            border-collapse: collapse;
            width: 500px;
            table-layout: fixed;
        }
        tr, th {
            font-weight: normal;
            border: 1px solid #000;
        }
        tr, td {
            border: 1px solid #000;
        }
        tr th {
            text-align: left;
            width: 150px;
            padding: 2px 2px 2px 8px;
        }
        tr td {
            text-align: left;
            padding: 2px 2px 2px 5px;
            width: 200px;
        }
        .details-of-application h2,
        .bio-data h2,
        .passport-details h2,
        .work-skills h2,
        .work-experience h2 {
            text-decoration: underline;
            margin-bottom: 5px;
        }
        <?php else: ?>
        body {
            font-size: 12px;
        }
        h2 {
            font-size: 16px;
        }
        .wrapper {
            /*width: 1200px;*/
            margin: 10px auto;
        }
        .logo {
            text-align: center;
        }
        .logo img {
            display: inline-block;
            width: 200px;
            height: 80px;
        }
        h2.center {
            text-align: center;
        }
        div.data {
            width: 550px;
            float: left;
        }
        div.personal-photo {
            width: 150px;
            float: left;
            border: 1px solid #000;
            /*margin-left: 10px;*/
            margin-top: 50px;
            padding: 5px;
        }

        div.personal-photo img {
            width: 150px;
            display: block;
        }
        table {
            border: 1px solid #000;
            border-collapse: collapse;
            width: 300px;
            table-layout: fixed;
        }
        tr, th {
            font-weight: normal;
            border: 1px solid #000;
        }
        tr, td {
            border: 1px solid #000;
        }
        tr th {
            text-align: left;
            width: 150px;
            padding: 2px 2px 2px 8px;
        }
        tr td {
            text-align: left;
            padding: 2px 2px 2px 5px;
            width: 200px;
        }
        .details-of-application h2,
        .bio-data h2,
        .passport-details h2,
        .work-skills h2,
        .work-experience h2 {
            text-decoration: underline;
            margin-bottom: 5px;
        }
        <?php endif; ?>
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="<?= site_url('assets/img/logo.png'); ?>" alt="">
        </div>
        <h2 class="center"></h2>
        <div class="person-info">

            <div class="data">
                <div class="bio-data">
                    <h2><?= lang('bio_data') ?></h2>
                    <table>
                        <tr>
                            <th><?= lang('position_applied') ?></th>
                            <td><?= $job; ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('monthly_salary'); ?></th>
                            <td><?= $worker->salary; ?>SAR</td>
                        </tr>
                        <tr>
                            <th><?= lang('contract_period'); ?></th>
                            <td><?= $worker->contract_period; ?> Years</td>
                        </tr>
                        <tr>
                            <th>الاسم</th>
                            <td><?= $worker->name; ?></td>
                        </tr>
                    </table>
                </div><!-- ./ bio-data -->

                <div class="details-of-application">
                    <h2><?= lang('details_of_applicant') ?></h2>
                    <table>
                        <tr>
                            <th><?= lang('nationality'); ?></th>
                            <td>
                                <?php
                                $this->load->module('worker_nationality');
                                echo $this->worker_nationality->Worker_nationality_model->get($worker->nationality_id, true)->nationality_in_arabic;
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('religion'); ?></th>
                            <td>
                                <?php
                                $this->load->module('religions');
                                echo $this->religions->Religion_model->get($worker->religion, true)->arabic_religion;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('date_of_birth'); ?></th>
                            <td><?= $worker->date_of_birth; ?></td>
                        </tr>
                        <tr>
                            <th><?= lang('marital_status'); ?></th>
                            <td>
                                <?php
                                switch ($worker->marital_status) {
                                    case '1':
                                        echo 'عزباء';
                                        break;
                                    case '2':
                                        echo 'متزوجة';
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= lang('weight'); ?></th>
                            <td><?= $worker->weight; ?> kgs</td>
                        </tr>
                        <tr>
                            <th><?= lang('height'); ?></th>
                            <td><?= $worker->height; ?> cms</td>
                        </tr>
                        <tr>
                            <th><?= lang('education_qualification') ?></th>
                            <td><?= $worker->qualification; ?></td>
                        </tr>
                    </table>
                </div>


                <div class="passport-details">
                    <h2>بيانات جواز السفر</h2>
                    <table>
                        <tr>
                            <th>رقم الجواز</th>
                            <td><?= $worker->passport_number; ?></td>
                        </tr>
                        <tr>
                            <th>تاريخ الاصدار</th>
                            <td><?= $worker->date_of_issue; ?></td>
                        </tr>
                        <tr>
                            <th>تاريخ الانتهاء</th>
                            <td><?= $worker->date_of_expiry; ?></td>
                        </tr>
                        <tr>
                            <th>مكان الاصدار</th>
                            <td><?= $worker->place_of_issue; ?></td>
                        </tr>
                    </table>
                </div><!-- ./passport-details -->

                <div class="work-skills">
                    <h2>مهارات العمل</h2>
                    <table>
                        <tr>
                            <th>اللغة العربية</th>
                            <td><?= get_yes_or_no($worker->arabic_language); ?></td>
                        </tr>
                        <tr>
                            <th>التنظيف</th>
                            <td><?= get_yes_or_no($worker->cleaning); ?></td>
                        </tr>
                        <tr>
                            <th>كى الملابس</th>
                            <td><?= get_yes_or_no($worker->ironing); ?></td>
                        </tr>
                        <tr>
                            <th>الطبخ</th>
                            <td><?= get_yes_or_no($worker->cooking); ?></td>
                        </tr>
                        <tr>
                            <th>رعاية الاطفال</th>
                            <td><?= get_yes_or_no($worker->baby_sitting); ?></td>
                        </tr>
                        <tr>
                            <th>رعاية كبار السن</th>
                            <td><?= get_yes_or_no($worker->old_care); ?></td>
                        </tr>
                    </table>
                </div><!-- ./work-skills -->

                <div class="work-experience">
                    <h2>الخبرات السابقة</h2>
                    <table>
                        <tr>
                            <th>مدة الخبرة</th>
                            <td><?= $worker->experience_period; ?></td>
                        </tr>
                    </table>
                </div>
                <br>

            </div>

            <div class="personal-photo">
                <img src="<?= site_url('assets/img/workers/' . $worker->image); ?>" alt="">
                <br>
                <img src="<?= site_url('assets/img/workers/' . $worker->passport_image) ?>" alt="">
            </div>

        </div>

    </div>
</body>
</html>