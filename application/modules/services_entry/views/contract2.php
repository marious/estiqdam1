<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contract Maid & Sponsor</title>
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border-color: #000;
        }
        body {margin:0;}
        .arabic {font-family: "simplified Arabic";font-size: 16px;direction:rtl;line-height: 100% ;font-weight: normal;}
        #intab{margin-top: 10px;}
        textarea{ resize: vertical; }
        .center {
            text-align: center;
        }
        table {
            border-collapse: collapse !important;
        }
        .table2 td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        }
        /*td {*/
            /*padding-left: 6px;*/
            /*padding-right: 6px;*/
        /*}*/
        .contract-header {
            border: 1px solid #000;
            height: 61px;
            width: 100%;
            margin: 0 auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border-bottom: none;
        }
        .contract-header p {
            margin: 0;
            padding: 4px 5px 6px 5px;
        }
        .ar-office-info {
            padding: 0;
            color: #00B0F0;
            font-size: 8.0pt;
            width: 35%;
            float: right;
            border-left: 1px solid #000;
            height: 60px;
            text-align: right;
        }
        .en-office-info {
            font-size: 8.0pt;
            width: 35%;
            color: #92D050;
            float: left;
            height: 60px;
            text-align: left;
            font-weight: bold;
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
        <?php if (!isset($contract_header)): ?>
        <?php
        $this->load->module('style_settings');
        $topMargin = $this->style_settings->Style_setting->get(1, true)->contract_2_top_margin;
        ?>
        body {
            margin-top: <?= $topMargin. 'cm'; ?>;
        }
        <?php endif; ?>
    </style>
</head>
<body>
<?php
$this->load->module('arrival_airports');
$arrival_airport = $this->arrival_airports->Arrival_airport_model->get($worker_info->arrival_airport_id, true);
?>

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
<!--<table width="100%" border="1">-->
<!--    <tr>-->
<!--        <td width="30%">Peace For Recruitment <br>Kingdom of Saudi Arabia Hail city </td>-->
<!--        <td style="text-align: center;"><img src="--><?//= site_url('assets/img/contract_logo.gif') ?><!--" alt=""></td>-->
<!--        <td width="30%" class="arabic">مكتب السلام للاستقدام <br>المملكة العربية السعودية مدينة حائل </td>-->
<!--    </tr>-->
<!--</table>-->

<!--    <table width="100%" class="table2">-->
<!--        <tr>-->
<!--            <td width="100" align="center">Phone هاتف </td>-->
<!--            <td width="100" align="center">Fax فاكس </td>-->
<!--            <td width="120" align="center">Mobile جوال </td>-->
<!--            <td width="150" align="center">Email البريد الالكتروني </td>-->
<!--            <td width="100" align="center">Saudi Labor License </td>-->
<!--            <td width="100" align="center">37 17 308 </td>-->
<!--            <td width="90" align="center">ترخيص وزارة العمل </td>-->
<!--        </tr>-->
<!--        <tr style="border-top: 1px solid #000;">-->
<!--            <td align="center">0165710400 </td>-->
<!--            <td align="center">0165710402 </td>-->
<!--            <td align="center">+966547830004 </td>-->
<!--            <td align="center">u.peace.t@gmail.com </td>-->
<!--            <td align="center">Commercial License </td>-->
<!--            <td align="center">3350044266 </td>-->
<!--            <td align="center">السجل التجاري </td>-->
<!--        </tr>-->
<!--    </table>-->

<table width="100%" border="1">
    <tbody>
    <tr>
        <td width="50%" align="center">Date <?= date('d/m/Y', strtotime($contract_info->contract_date)); ?> <span class="arabic">التاريخ</span> </td>
        <td align="center">Contract Number <?= $contract_info->contract_number; ?>  <span class="arabic">رقم العقد</span>  </td>
    </tr>
    <tr style="font-size: 16px;">
        <td style="border: none;"  align="left">Housemaid contract from: <?= $worker_info->country_name_in_english; ?> <span></span></td>
        <td style="borde-left: 1px solid #000;" align="right"> عقد العمل للعاملة المنزلية من: <?= $worker_info->country_name_in_arabic ?></td>

    </tr>
    <tr>
        <td>The employment contract is between: </td>
        <td class="arabic">تم إبرام هذا العقد بين كل من: </td>
    </tr>
    <tr>
        <td>First party Employer: </td>
        <td class="arabic">الطرف الأول صاحب العمل: </td>
    </tr>
    <tr>
        <td>Name: <span style=""><?= $customer_info->customer_name_in_english; ?></span> </td>
        <td class="arabic">الاسم: <span><?= $customer_info->customer_name_in_arabic; ?></span></td>
    </tr>
    </tbody>
</table>
<table width="100%" class="table2">
    <tbody>
    <tr>
        <td width="25%" align="center">City  المدينة  </td>
        <td width="25%" align="center">Mobile  الجوال  </td>
        <td width="25%" align="center">National ID رقم الهوية</td>
        <td width="25%" align="center">Visa number رقم التأشيرة </td>
    </tr>
    <tr>
        <td align="center"><?php  echo $arrival_airport->name_in_english . ' ' . $arrival_airport->name_in_arabic; ?></td>
        <td align="center"><?= $customer_info->customer_mobile; ?></td>
        <td align="center"><?= $customer_info->customer_id; ?></td>
        <td align="center"><?= $customer_info->visa_number; ?></td>
    </tr>
    </tbody>
</table>
<table width="100%" style="border: 1px solid #000;">
    <tbody>
    <tr>
        <td width="30%">Second Party Housemaid </td>
        <td align="center">Passport Num رقم الجواز </td>
        <td width="30%" class="arabic">الطرف الثاني العامل / العاملة </td>
    </tr>
    <tr>
        <td><span><?= $worker_info->worker_name_in_english; ?></span></td>
        <td align="center"><?= $worker_info->passport_number; ?></td>
        <td align="right"><span><?= $worker_info->worker_name_in_arabic; ?></span></td>
    </tr>
    </tbody>
</table>

<table width="100%"  style="border-left: 1px solid #000; border-right: 1px solid #000;">
    <tr>
        <td style="padding: 4px;">&nbsp;</td>
    </tr>

</table>

<table width="100%" border="1" style="border-top: none;">
    <tbody>
    <tr>
        <td align="center" style="font-weight: bold;"><span class="arabic">: وبعد التراضي قام الطرفان بالالتزام بالبنود والشروط التالية </span> <br>Voluntarily binding themselves to the following terms and conditions:</td>
    </tr>
    <tr>
        <td> <div class="arabic">مدة العقد سنتين من تاريخ وصول العاملة إلى السعودية. ويبدأ الراتب الشهري بعد مباشرة  العمل  بشكل فعلي.يخضع الطرف الثاني العاملة المنزلية لفترة تجربة مدتها 90 يوم من تاريخ وصولها للسعودية و في حالة رفضها العمل بدون سبب تتحمل كافة تكاليف الاستقدام التي دفعها الطرف الأول. في حالة  نشوء نزاع بين  صاحب العمل  والعاملة المنزلية ، يمكن لكلا طرفي العقد إحالة  النزاع  إلى الجهات السعودية المختصة  للتقاضي  والتسوية.  </div>


            1. Contract Duration: Two years effective from the date of Arrived to Saudi Arabia. The monthly salary shall start upon actual reporting to work.Second party Housemaid is subject to a period of 90 days from the experience of the date of delivery to Saudi Arabia and in the case of refusal to work without reason bear all recruitment costs paid by the first party. In case of dispute between the employer and the housemaid, the two contracting parties may refer the dispute to the appropriate Saudi authorities for conciliation and/or resolution

        </td>

    </tr>
    <tr>
        <td><div class="arabic">. راتب العاملة  المنزلية <?= number_format($worker_info->worker_salary, 0, '.', ''); ?> ريال سعودي. السكن و الإعاشة على الكفيل.</div>2. The salary of housemaid will be only <?= number_format($worker_info->worker_salary, 0, '.', ''); ?> SAR. Subsistence & housing will be provided by the sponsor.</td>

    </tr>
    <tr>
        <td><div class="arabic">تمكين العاملة المنزلية من راحة متواصلة لا تقل عن (8) ساعات يومياً .</div>
            3. The Housemaid shall be provided with continuous rest of at least 8 hours per day.
        </td>
    </tr>
    <tr>
        <td><div class="arabic">يتعامل صاحب العمل وأفراد أسرته  والعاملة المنزلية  في المملكة مع  بعضهم البعض  بمعاملة  حسنة  و باحترام  وكرامة .</div>
            4. The employer and his family members, and the Housemaid shall treat one another with respect and dignity.

        </td>
    </tr>
    <tr>
        <td><div class="arabic">يسمح للعاملة المنزلية بالاتصال الهاتفي بعائلتها على حسابها الشخصي.</div>
            5. The Housemaid shall be allowed to communicate with her family on her personal expense.
        </td>
    </tr>
    <tr>
        <td><div class="arabic">يدفع صاحب العمل رسوم الإقامة والخروج والعودة والخروج النهائي للعاملة المنزلية ، بالإضافة إلى رسوم التجديد والغرامات المترتبة على التأخير.</div>
            6. The employer shall pay the cost of the housemaid's residence permit (iqama), exit/re-entry visa, and final exit visa, including the renewals and penalties resulting from delays.
        </td>
    </tr>
    <tr>
        <td><div class="arabic">يمكن تجديد هذا العقد بالاتفاق بين العامل / العاملة المنزلية مع صاحب العمل .</div>
            7. This contract may be renewed upon the agreement of the Housemaid and her employer.
        </td>
    </tr>
    <tr>
        <td><div class="arabic">حرر هذا العقد من نسختين أصليتين باللغة  الإنجليزية والعربية ، ويتم  الاعتماد  عليهما  والعمل  بموجبه بالتساوي .</div>

            8. This contract  written in two original copies in the English and Arabic text, both copies being equally authentic.
        </td>
    </tr>
    </tbody>
</table>
<table width="100%" border="0">
    <tbody>
    <tr>
        <td align="center" width="50%">Housemaid Signature  توقيع العاملة المنزلية</td>
        <td align="center">Employer  Signature توقيع صاحب العمل</td>
    </tr>
    <tr>
        <td align="center"></td>
        <td>&nbsp;</td>
    </tr>
    </tbody>
</table>

<script type="text/javascript">window.print()</script>
</body>
</html>