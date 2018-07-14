<?php
$this->load->module('arrival_airports');
$arrival_airport = $this->arrival_airports->Arrival_airport_model->get($worker_info->arrival_airport_id, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<!--    <link rel="stylesheet" href="--><?//= site_url('assets/fonts/amiri/amiri.css') ?><!--">-->
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        @font-face {
            font-family: myFont;
            src: url(<?= site_url('assets/fonts/KacstOne.ttf') ?>);
        }
        /*@font-face {*/
            /*font-family: KacstOne;*/
            /*src: url(KacstOne.ttf);*/
        /*}*/
        body {
            direction: rtl;
            font-family: myFont;
            font-size: 9pt;
            font-weight: 500;
            line-height: 1.4em;
        }
        .contract {
            margin-top: 10px;
        }
        .contract-header {
            border: 1px solid #000;
            /*height: 53px;*/
            height: 66px;
            width: 717px;
            margin: 0 auto;

        }
        .ar-office-info {
            padding: 0;
            color: #00B0F0;
            font-size: 8.0pt;
            width: 35%;
            float: right;
            border-left: 1px solid #000;
            height: 66px;
            padding-right: 5px;
        }
        .en-office-info {
            font-size: 8.0pt;
            width: 35%;
            color: #92D050;
            float: left;
            height: 66px;
            text-align: left;
            font-weight: bold;
            padding-left: 5px;
            border-right: 1px solid #000;
        }
        .office-logo {
            width: 28%;
            float: right;
            height: 53px;
            text-align: center;
            padding-top: 4px;
            box-sizing: border-box;
        }
        table {
            border: 1px solid #000;
            border-collapse: collapse;
        }
        tr,th,td {
            border: 1px solid #000;
        }
        th {
            padding: 10px;
        }
        td {
            text-align: center;
            padding: 6px;
        }
        div.contract-footer {
            overflow: hidden;
            margin-top: 30px;
        }
        div.contract-footer div {
            width: 40%;
            float: right;
        }
        div.contract-footer div:last-child {
            float: left;
            width: 40%;
        }
        <?php if (!isset($contract_header)): ?>
        <?php
        $this->load->module('style_settings');
        $topMargin = $this->style_settings->Style_setting->get(1, true)->contract_1_top_margin;
        ?>
        body {
            margin-top: <?= $topMargin. 'cm'; ?>;
        }
        <?php endif; ?>
    </style>
</head>
<body>
<div class="contract">
    <?php if (isset($contract_header) && $contract_header == true): ?>
        <?php
        $this->load->module('site_settings');
        $institution = $this->Site_setting_model->get()[0];
        ?>
        <div class="contract-header">
            <div class="ar-office-info">
                <p>
                    <?= $institution->name_in_arabic; ?>
                    <br>
                    <?= $institution->address_in_arabic; ?>
                    <br>
                    هاتف   <?= $institution->phone ?>  فاكس  <?= $institution->fax; ?>

                    <br>
                    جوال/ +<?= $institution->mobile; ?>
                </p>
            </div>

            <div class="office-logo">
                <img src="<?= site_url('assets/img/contract_logo.gif') ?>" alt="">
            </div>

            <div class="en-office-info">
                <p>
                    <?= $institution->name_in_english; ?>
                    <br>
                    <?= $institution->address_in_english; ?>
                    <br>
                    Phone: <?= $institution->phone; ?> Fax: <?= $institution->fax; ?>
                    <br>
                    Mobile/ +<?= $institution->mobile; ?>
                </p>
            </div>
        </div><!-- ./contract-header -->
    <?php endif; ?>

    <div class="contratct-content">
        <br>
        <p>
            حرر هذا العقد فى يوم <?php echo  ($show_date == true) ? arabic_day(date('l', strtotime($contract_info->contract_date))) : '&nbsp;&nbsp;&nbsp;&nbsp;'; ?> <span style="inline-block; margin-right: 30px;">بتاريخ:</span>  <?php echo ($show_date == true) ?  date('d/m/Y', strtotime($contract_info->contract_date)) : '';?> <br>
            <span style="font-size: 15px;">الطرف الاول: مكتب السلام للاستقدام</span>    <br>
 <span style="font-size: 15px;">
                 الطرف الثانى/ <?php echo $customer_info->customer_name_in_arabic; ?>   &nbsp;الجنسية: <?= $customer_info->nationality_in_arabic; ?> &nbsp;  رقم الهوية: <?php echo $customer_info->customer_id; ?>&nbsp;&nbsp; الجوال: <?php echo $customer_info->customer_mobile; ?>
 </span><br>
            حيث أن الطرف الأول مرخص له بالتوسط في استقدام الأيدي العاملة ولرغبة الطرف الثاني في قيام الطرف
            الأول بإنهاء إجراءات استقدام العمالة من الخارج فقد اتفق الطرفان وهما في كامل أهليتهما المعتبرة شرعا

            ونظاماً على ما يلي :  <br>

            أولاً : موضوع العقد : <br>

            بموجب هذا العقد فوض الطرف الثاني الطرف الأول القيام نيابة عنه بإنهاء كافة الإجراءات اللازمة للاستقدام بما
            في ذلك اختيار العاملة وتوقيع عقد مع  المستقدم فى بلده وله الحق في تفويض الغير مع استمرار مسئولية
            الطرف الأول عن التزاماته بموجب التأشيرات الصادرة للطرف الثاني وفقاً للجدول التالي :

        </p>

        <table>
            <tr>
                <td>العدد</td>
                <td>المهنة</td>
                <td>الجنسية</td>
                <td>جهة القدوم</td>
                <td>رقم التأشيرة</td>
                <td>تاريخها</td>
                <td>ملاحظات</td>
            </tr>
            <tr>
                <td width="">1</td>
                <td width="18%"><?php echo $worker_info->job_name_in_arabic; ?></td>
                <td width=""><?php echo $worker_info->nationality_in_arabic; ?></td>
                <td width="18%"><?php echo $worker_info->city; ?></td>
                <td width="18%"><?php echo $customer_info->visa_number; ?></td>
                <?php
               // $visa_data = date('d/m/Y', strtotime($customer_info->visa_date));
                ?>
                <td width="18%"><?php echo $customer_info->visa_date; ?></td>
                <td width="100%"><?= $contract_info->notes_1; ?></td>
            </tr>
        </table>
        <p>
                        تمهيد: <br>
            حيث أن الطرف الاول مرخص له بالتوسط فى استخدام العمالة المنزلية، ولرغبة الطرف الثانى فى قيام الطرف الاول، بإنهاء إجراءات استقدام العمالة المنزلية من الخارج، فقد اتفق الطرفان، وهما بكامل أهليتهما المعتبرة شرعا ونظاما على ما يلى:
        </p>

        <p style="margin-top: 10px;">
            أولاً : موضوع العقد : <br>
            بموجب هذا العقد فوض الطرف الثاني الطرف الأول القيام نيابة عنه بإنهاء كافة الإجراءات اللازمة للاستقدام بما
            في ذلك اختيار العاملة وتوقيع عقد مع المستقدم فى بلده  وله الحق في تفويض الغير مع استمرار مسئولية
            الطرف الأول عن التزاماته بموجب التأشيرات الصادرة للطرف الثاني وفقاً للجدول اعلاه.

        </p>

        <p>
            ثانياً : التزامات الطرف الأول : <br>
           <span style="font-size: 16px;">الشروط المطلوبة في المستقدم</span> <br>
            <span class="small-list">١ -</span> يلتزم الطرف الأول بإنهاء إجراءات الاستقدام وفقاً لبيانات المستقدم المذكورة في الجدول الوارد في أولاً.
            <br>
            <span class="small-list">٢ -</span> يلتزم الطرف الأول بإجراء الفحص الطبي الشامل للعامل قبل وصوله للمملكة للتأكد من أنه لائق صحياً ولا يعاني
            من أي مرض مزمن أو معد لا يمكنه من أداء عمله كما يلتزم بإرفاق تقاريره الطبية بعقد العمل.  <br>

            <span class="small-list">٣ - </span>يلتزم الطرف الأول بإجراء فحص أمنى للعامل من الجهات الرسمية المختصة فى بلده للتأكد من خلوه من السوابق الجنائية.
            <br>
            <span class="small-list">٤ - </span>إذا كان المطلوب استقدام أنثى فيشترط أن تكون خالية من الحمل.
            <br>
            <span class="small-list">٥ - </span> إذا كان المطلوب استقدامه من العمالة الفنية والماهرة فيجب أن تتوافر فيه المؤهلات والخبرات مع إجادة
            المهنة المطلوبة. <br>

            <span class="small-list">٦ - </span> إذا كان المطلوب استقدامه بمهنة سائق فيجب أن تكون لديه رخصة قيادة سارية المفعول من بلده مع
            إجادة القيادة.

            <br>

            <span class="small-list">٧ - </span> إذا كان المستقدم معيناً بالاسم من قبل الطرف الثانى فلا يلتزم الطرف الأول بالشروط أعلاه عدا
            الشرط المبين فى البند (٢) المتعلق بالفحص الطبى  والشرط المبين فى البند (٣) المتعلق بالفحص الامنى.

            <br>

            <span class="small-list">٨ - </span> يلتزم الطرف الأول بإحاطة العامل المستقدم بجميع الشروط التي يطلب الطرف الثاني توافرها فيه  كما
            يلتزم باطلاعه على العقد الذي سيبرم بينه وبين الطرف الثاني ويحيطه بحقوقه وواجباته المحددة فى لائحة عمال الخدمة المنزلية ومن فى حكمهم ويحصل على توقيعه بالموافقة على تلك الشروط.

            <br>

            <span class="small-list">٩ - </span>  يلتزم الطرف الاول بتزويد الطرف الثانى بنسخة اصلية من العقد المبرم مع العامل المستقدم بعد اكتمال تواقيعه.

            <br>

           <span style="font-size: 16px;"> شروط العقد المبرم مع العامل المستقدم</span>   <br>بموجب التفويض المنوه عنه أعلاه يلتزم الطرف الأول أن يبرم عقداً مع العامل المستقدم نيابة عن الطرف الثاني وفق ما يلى :

            <br>
            ١ - يجب ان يكون العقد وفق النموذج القياسى المعتمد من وزارة العمل بالمملكة العربية السعودية الخاص بجنسية العامل المستقدم.
            <br>
            ٢ - يجب ان يتضمن العقد البيانات التالية:

        </p>

        <table style="min-width: 100%;">
            <tr>
                <td>المهنة</td>
                <td>المؤهلات والخبرات</td>
                <td>مدة العقد</td>
                <td>الأجر</td>
                <td>مدة الاجازة</td>
                <td>ملاحظات</td>
            </tr>
            <tr>
                <td width="15%"><?php echo $worker_info->job_name_in_arabic; ?></td>
                <td width="18%"><?= $worker_info->qualification; ?></td>
                <td width="15%">24 شهر</td>
                <td width=15%"><?php echo $worker_info->worker_salary; ?> ريال</td>
                <td width="15%"><?= $contract_info->vacation_period; ?></td>
                <td width="100%"><?= $contract_info->notes_2; ?></td>
            </tr>
        </table>
        <p>

            ١- اتفق الطرفان على ان تكون تكلفة الاستقدام مبلغ وقدره ( <?php echo number_format($finance_info->recruitment_cost); ?> ) ريال سعودى تدفع للطرف الأول عن كل عامل مستقدم وذلك مقابل أتعاب وتكلفة الاستقدام شاملة قيمة تذكرة السفر من البلد المستقدم منها العامل وحتى وصوله الى مدينة ( <?= $arrival_airport->name_in_arabic; ?> ) بالمملكة العربية السعودية.

            <br>

            2-      يدفع الطرف الثاني نسبة ( 25 % ) من مبلغ التكلفة مقدماً عند توقيع العقد وذلك مبلغ ( <?= number_format($finance_info->prepaid_money, 2); ?> ) ريال ونسبة (75%) المتبقية ومبلغها ( <?= number_format(($finance_info->remains_money)); ?> ) ريال. تدفع عند إشعار الطرف الأول للطرف الثاني كتابة بالسداد على ما يفيد التأشير على جواز سفر المستقدم من السفارة السعودية في بلد المستقدم.

            <br>
            أوافق على جميع بنود العقد بالخلف بما فيها المنصوص عليها بالخلف.
        </p>

        <div class="contract-footer">
            <div>
                الطرف الاول: مكتب السلام للاستقدام
                <br>
                ختم المكتب :
            </div>

            <div>
                الطرف الثانى: <?php echo $customer_info->customer_name_in_arabic; ?>  <br>

                 التوقيع :
            </div>

        </div>


    </div>
    <script>//window.print()</script>
</div><!-- ./ contract -->

<script>window.print();</script>
</body>
</html>
