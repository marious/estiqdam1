<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        body {
            direction: rtl;
            font-family: arial;
        }
        .contract {
            margin-top: 10px;
        }
        .contract-header {
            border: 1px solid #000;
            height: 53px;
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
            height: 53px;
            padding-right: 5px;
        }
        .en-office-info {
            font-size: 8.0pt;
            width: 35%;
            color: #92D050;
            float: left;
            height: 53px;
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
        }

    </style>
</head>
<body>
    <div class="contract">

        <?php if (isset($contract_header) && $contract_header == true): ?>
        <div class="contract-header">
            <div class="ar-office-info">
                <p>
                    مكتب السلام للاستقدام
                    <br>
                    المملكة العربية السعودية مدينة حائل
                    <br>
                    هاتف   0165710400  فاكس  0165710402
                    <br>
                    جوال/ +966547830004
                </p>
            </div>

            <div class="office-logo">
                <img src="<?= site_url('assets/img/contract_logo.gif') ?>" alt="">
            </div>

            <div class="en-office-info">
                <p>
                    Peace For Recruitment
                    <br>
                    Kingdom of Saudi Arabia Hail city
                    <br>
                    Phone: 0165710400 Fax: 0165710402
                    <br>
                    Mobile/ +966547830004
                </p>
            </div>
        </div><!--./contract-header -->
        <?php endif; ?>

        <div class="contract-details">
            <p>حرر هذا العقد فى يوم <?php echo arabic_day(date('l', strtotime($contract_info->contract_date))) ?> بتاريخ <?php echo date('d-m-Y', strtotime($contract_info->contract_date)) ?></p>
            <p>الطرف الاول مكتب السلام للاستقدام</p>
            <p>الطرف الثانى /<?php echo $customer_info->customer_name_in_arabic; ?>، الجنسية سعودى رقم الهوية <?php echo $customer_info->customer_id; ?> الجوال <?php echo $customer_info->customer_mobile; ?></p>
            <p>وعنوانه:........... ص.ب:........... رمز بريدى ..... هاتف العمل:............</p>
            <p>
                حيث أن الطرف الأول مرخص له بالتوسط في استقدام الأيدي العاملة ولرغبة الطرف الثاني في قيام الطرف الأول بإنهاء إجراءات استقدام العمالة من الخارج فقد اتفق الطرفان وهما في كامل أهليتهما المعتبرة شرعاً ونظاماً على ما يلي :
            </p>
            <p>أولاً : موضوع العقد :</p>
            <p>
                بموجب هذا العقد فوض الطرف الثاني الطرف الأول القيام نيابة عنه بإنهاء كافة الإجراءات اللازمة للاستقدام بما في ذلك اختيار العاملة وتوقيع عقد مع المستقدم بلده في وله الحق في تفويض الغير مع استمرار مسئولية الطرف الأول عن التزاماته بموجب التأشيرات للطرف الثاني وفقاً للجدول التالي :
            </p>

            <table class="MsoTableGrid" dir="rtl" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:none;mso-border-alt:solid black .5pt;
 mso-border-themecolor:text1;mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;
 mso-table-dir:bidi">
                <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes">
                    <td width="73" valign="top" style="width:54.95pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">العدد/الاسم<o:p></o:p></span></p>
                    </td>
                    <td width="76" valign="top" style="width:57.25pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">المهنة<o:p></o:p></span></p>
                    </td>
                    <td width="68" valign="top" style="width:51.15pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">الجنسية<o:p></o:p></span></p>
                    </td>
                    <td width="82" valign="top" style="width:61.7pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">جهة القدوم<o:p></o:p></span></p>
                    </td>
                    <td width="113" valign="top" style="width:85.05pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">رقم
  التأشيرة<o:p></o:p></span></p>
                    </td>
                    <td width="76" valign="top" style="width:56.7pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">تاريخها<o:p></o:p></span></p>
                    </td>
                    <td width="142" valign="top" style="width:106.3pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">ملاحظات<o:p></o:p></span></p>
                    </td>
                </tr>
                <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes">
                    <td width="73" valign="top" style="width:54.95pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-top:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span dir="RTL"></span><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:
  7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-bidi;
  mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:minor-bidi"><span dir="RTL"></span>1<o:p></o:p></span></p>
                    </td>
                    <td width="76" valign="top" style="width:57.25pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="mso-ansi-font-size:6.0pt;mso-bidi-font-size:11.0pt;
  font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:
  minor-bidi;mso-bidi-theme-font:minor-bidi"><?php echo $worker_info->job_name_in_arabic; ?><o:p></o:p></span></p>
                    </td>
                    <td width="68" valign="top" style="width:51.15pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><?php echo $worker_info->nationality_in_arabic; ?><o:p>&nbsp;</o:p></span></p>
                    </td>
                    <td width="82" valign="top" style="width:61.7pt;border-top:none;border-left:solid black 1.0pt;
  mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:
  text1;border-right:none;mso-border-top-alt:solid black .5pt;mso-border-top-themecolor:
  text1;mso-border-right-alt:solid black .5pt;mso-border-right-themecolor:text1;
  mso-border-alt:solid black .5pt;mso-border-themecolor:text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><?php echo $worker_info->city; ?><o:p>&nbsp;</o:p></span></p>
                    </td>
                    <td width="113" valign="top" style="width:85.05pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><?php echo $customer_info->visa_number; ?><o:p>&nbsp;</o:p></span></p>
                    </td>
                    <td width="78" valign="top" style="width:56.7pt;border-top:none;border-left:solid black 1.0pt;
  mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:
  text1;border-right:none;mso-border-top-alt:solid black .5pt;mso-border-top-themecolor:
  text1;mso-border-right-alt:solid black .5pt;mso-border-right-themecolor:text1;
  mso-border-alt:solid black .5pt;mso-border-themecolor:text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><?php echo $customer_info->visa_date; ?><o:p>&nbsp;</o:p></span></p>
                    </td>
                    <td width="142" valign="top" style="width:106.3pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                        <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><o:p>&nbsp;</o:p></span></p>
                    </td>
                </tr>
                </tbody></table>

            <p>ثانياً: التزامات الطرف الأول :</p>
            <p>1- الشروط المطلوبة في المستقدم</p>

            <?php include 'contract/customer_conditions.php'; ?>

            <span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"><span dir="RTL"></span>2- شروط
العقد المبرم
مع العامل
المستقدم: <o:p></o:p></span>
            <span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">1-2 : بموجب
التفويض
المنوه عنه
أعلاه يلتزم
الطرف الأول
أن يبرم عقداً
مع العامل
المستقدم نيابة
عن الطرف
الثاني والذي
يجب أن يتضمن
ما يلي : <o:p></o:p></span>
            <div align="right" dir="rtl">

                <table class="MsoTableGrid" dir="rtl" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:none;mso-border-alt:solid black .5pt;
 mso-border-themecolor:text1;mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;
 mso-table-dir:bidi">
                    <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes">
                        <td width="109" valign="top" style="width:82.1pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">المهنة<o:p></o:p></span></p>
                        </td>
                        <td width="109" valign="top" style="width:82.1pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">المؤهلات
  والخبرات<o:p></o:p></span></p>
                        </td>
                        <td width="109" valign="top" style="width:82.1pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">مدة العقد<o:p></o:p></span></p>
                        </td>
                        <td width="109" valign="top" style="width:82.1pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">الأجر<o:p></o:p></span></p>
                        </td>
                        <td width="110" valign="top" style="width:82.15pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">مدة
  الإجازة<o:p></o:p></span></p>
                        </td>
                        <td width="110" valign="top" style="width:82.15pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-right:none;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">ملاحظات<o:p></o:p></span></p>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes">
                        <td width="109" valign="top" style="width:82.1pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-top:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><?php echo $worker_info->job_name_in_arabic; ?><o:p></o:p></span></p>
                        </td>
                        <td width="109" valign="top" style="width:82.1pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">...............<o:p></o:p></span></p>
                        </td>
                        <td width="109" valign="top" style="width:82.1pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">24 شهر<o:p></o:p></span></p>
                        </td>
                        <td width="109" valign="top" style="width:82.1pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><?php echo $worker_info->worker_salary; ?> ريال<o:p></o:p></span></p>
                        </td>
                        <td width="110" valign="top" style="width:82.15pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi">0 شهر<o:p></o:p></span></p>
                        </td>
                        <td width="110" valign="top" style="width:82.15pt;border-top:none;border-left:
  solid black 1.0pt;mso-border-left-themecolor:text1;border-bottom:solid black 1.0pt;
  mso-border-bottom-themecolor:text1;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-right-alt:solid black .5pt;
  mso-border-right-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0in 5.4pt 0in 5.4pt">
                            <p class="MsoNormal" align="center" dir="RTL" style="text-align:center"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
  mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
  minor-bidi"><o:p>&nbsp;</o:p></span></p>
                        </td>
                    </tr>
                    </tbody></table>

            </div>

            <span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"><span dir="RTL"></span>2-2:
مراعاة
العادات
والتقاليد
الإسلامية
واحترام
أنظمة
المملكة
وتعليماتها.<o:p></o:p></span>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">2-3 : ألا يكون
العامل من
المحظور
استقدامهم أو
التعاقد معهم
قبل مضي مدة
محددة نفاذاً
لتعليمات أو
قرارات. <o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">2-4: فترة
تجربة مدتها ( 90 )
يوم من تاريخ
مباشرة العمل.<o:p></o:p></span></p>
            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">2-5 : تذكرة
عودة لبلاده
بعد انتهاء
مدة العقد بالوسيلة
التي قدم
عليها. <o:p></o:p></span></p>
            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">2-6 : عنوان
العامل المستقدم
الثابت في
بلده. <o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">3- المدة
الزمنية
لوصول العامل:
<o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">يلتزم
الطرف الأول
بوصول العامل
المستقدم
خلال مدة
أقصاها (60)
يوماً من
تاريخ هذا
العقد.<o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">ثالثاً :
التزامات
الطرف الثاني
: <o:p></o:p></span></p>

            <p class="MsoListParagraphCxSpFirst" dir="RTL" style="text-align:justify;
text-indent:-.25in;mso-list:l0 level1 lfo2"><!--[if !supportLists]--><span style="font-size:16.0pt;mso-bidi-font-size:12.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-fareast-font-family:Arial;mso-fareast-theme-font:
minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:minor-bidi"><span style="mso-list:Ignore">1-<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span dir="RTL"></span><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"><span style="mso-spacerun:yes">&nbsp;</span>تكلفة
الاستقدام
المتفق عليها
هي ( </span><?php echo $finance_info->recruitment_cost; ?><span lang="AR-SA" style="font-size:5.0pt;font-family:
&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;
mso-bidi-theme-font:minor-bidi"></span><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"> ) ريال سعودي
تدفع للطرف
الأول عن كل
مستقدم مقابل
كافة أتعاب
استقدام بما
في ذلك قيمة
تذاكر السفر
حتى وصول
المستقدم إلى
مدينة ( حائل ) بالمملكة
العربية
السعودية. </span><span dir="LTR" style="font-size:7.0pt;mso-bidi-font-size:12.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"><o:p></o:p></span></p>
            <p class="MsoListParagraphCxSpLast" dir="RTL" style="text-align:justify;text-indent:
-.25in;mso-list:l0 level1 lfo2"><!--[if !supportLists]--><span dir="RTL"></span><span style="font-size:16.0pt;mso-bidi-font-size:12.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-fareast-font-family:Arial;mso-fareast-theme-font:
minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:minor-bidi"><span style="mso-list:Ignore">2-<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span dir="RTL"></span><span dir="RTL"></span><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"><span dir="RTL"></span><span style="mso-spacerun:yes">&nbsp;</span>يدفع
الطرف الثاني
نسبة ( 25 % ) من
مبلغ التكلفة
مقدماً عند
توقيع العقد
وذلك مبلغ ( </span><span lang="AR-SA" style="font-size:5.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:
minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:minor-bidi">......................</span><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"> ) ريال ونسبة
(75%) المتبقية
ومبلغها ( </span><span lang="AR-SA" style="font-size:5.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:
minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:minor-bidi">......................</span><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"> ) ريال. تدفع
عند إشعار
الطرف الأول
للطرف الثاني
كتابة
بالسداد على
ما يفيد
التأشير على
جواز سفر
المستقدم من
السفارة
السعودية في
بلد المستقدم.</span><span dir="LTR" style="font-size:7.0pt;mso-bidi-font-size:12.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi"><o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">أوافق على
جميع بنود
العقد بالخلف.<o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify;text-indent:.5in"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">الطرف الأول
<span style="mso-tab-count:6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="mso-tab-count:2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>الطرف
الثاني <o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">الاسم : <span style="mso-tab-count:
3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="mso-tab-count:2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>الصفة
: <span style="mso-tab-count:4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>الاسم
: <o:p></o:p></span></p>

            <p class="MsoNormal" dir="RTL" style="text-align:justify"><span lang="AR-SA" style="font-size:12.0pt;mso-ansi-font-size:7.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-bidi;mso-hansi-theme-font:minor-bidi;mso-bidi-theme-font:
minor-bidi">التوقيع : <span style="mso-tab-count:4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="mso-tab-count:1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>ختم
المكتب<span style="mso-tab-count:3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>التوقيع
: <o:p></o:p></span></p>


            <?php include 'contract/contract_bands.php'; ?>



        </div>

    </div><!-- ./contract -->


    <script>window.print();</script>
</body>
</html>