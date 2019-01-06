<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            direction: rtl;
            font-size: 14px;
        }
        p {
            line-height: 1em;
        }
        table {
            border-collapse: collapse;
            border: 1px solid #000;
        }
        tr,th, td {
            border: 1px solid #000;
            padding: 2px;
        }
        tr th, tr td {
            width: 50%;
        }
        .blank-row {
            height: 20px !important;
            background-color: #ccc;
        }
        .english-char {
            direction: ltr;
        }
        td h4 {
            font-weight: normal;
            font-size: 18px;
            padding: 5px 5px 0;
            margin: 0;
        }
        td h2 {
            font-size: 19px;
            padding: 5px 5px 0;
            font-weight: normal;
            margin: 0;
        }
        @media print {
            table,
            table tr td,
            table tr th {
                page-break-inside: avoid;
            }
            table { page-break-inside:auto; page-break-after: auto; }
            tr    { page-break-inside:avoid; page-break-after:auto }
            /*td    { page-break-inside:avoid; page-break-after:auto }*/
            /*th    { page-break-inside:avoid; page-break-after:auto }*/
        }

        .extra-padding {
            padding: 20px 20px 100px;
        }

        .small-text td {
            font-size: 12px;
        }

        @page {
            margin-top: 4.5cm;
            margin-bottom: 2cm;
        }

        @media print {
            body {
                /*margin-top: 50mm;*/
            }
        }
        span.customer-name {
            text-decoration: underline;
            margin: 0 4px;
        }
        .m-t-5 {
            margin-top: 5px;
        }
        .underline {
            text-decoration: underline;
        }


    </style>
</head>
<body>

<div class="contract-wrapper">
    <table>
        <tr class="blank-row">
            <td colspan="2"></td>
        </tr>
        <tr>
            <th>عقد العمل الخاص بالعمالة المنزلية الفلبينية المغادرة للمملكة العربية السعودية</th>
            <th>STANDARD EMPLOYMENT CONTRACT FOR FILIPINO HOUSEHOLD SERVICE WORKERS (HSWs) BOUND FOR THE KINGDOM OF SAUDI ARABIA</th>
        </tr>
        <tr class="blank-row">
            <td colspan="2"></td>
        </tr>
        <tr>
            <td><h4>تم إبرام هذا العقد بين كل من:</h4></td>
            <td class="english-char"><h4>This employment contract is executed and entered into by and between:</h4></td>
        </tr>
        <tr>
            <td>
                <h2>أ : صاحب العمل</h2>
                <span class="customer-name"><?= $customer_info->customer_name_in_arabic; ?></span>
                <p class="m-t-5">
                    رقم التأشيرة الصادرة من وزارة العمل السعودية : <?= $customer_info->visa_number; ?>
                    <br>
                     عنوانه : <?= $customer_data->customer_address; ?>
                    <br>
                    الشارع : <?= $customer_data->street; ?><br>
                    المنطقة : <?= $customer_data->area; ?><br>
                    المدينة : <?= $customer_data->city; ?><br>
                    الحالة الاجتماعية : <?php echo ($customer_data->civil_status == 1) ? 'أعزب' : 'متزوج'; ?> <br>
                    عدد أفراد الاسرة : <?= $customer_data->family_members; ?><br>
                    <span>أرقام الاتصالات</span>
                    <br>
                    رقم الهاتف/الهواتف : <?= $customer_data->phone_number; ?>
                    <br>
                    رقم الجوال : <?= $customer_data->customer_mobile; ?>
                    <br>
                    البريد الالكترونى : info@peace4r.com
                </p>
            </td>
            <td class="english-char">
                <h2>A. Employer: </h2>
                <span class="customer-name"><?= $customer_info->customer_name_in_english; ?></span>
                <p class="m-t-5">
                    Visa Number issued by the Saudi Ministry of labor : <?= $customer_info->visa_number; ?>
                    <br>
                    Address : <?= $this->arabic->ar2en($customer_data->customer_address); ?>
                    <br>
                    street : <?= $this->arabic->ar2en($customer_data->street); ?>
                    <br>
                    District : <?= $customer_data->english_area; ?>
                    <br>
                    City : <?= $customer_data->english_city; ?>
                    <br>
                    Civil Status : <?php echo ($customer_data->civil_status == 1) ? 'SINGLE' : 'MARRIED'; ?>
                    <br>
                    Number Of Family Members : <?= $customer_data->family_members; ?>
                    <br>
                    Contact Numbers:
                    <br>
                    Telephone Number : <?= $customer_data->phone_number; ?>
                    <br>
                    Mobile Number : <?= $customer_data->customer_mobile; ?>
                    <br>
                    E-mail Address : info@peace4r.com
                </p>
            </td>
        </tr>

        <tr>
            <td>
                <p>
                    ويمثل عنه فى المملكة العربية السعودية : <br>
                    مكتب الاستقدام السعودى : <span class="underline">مكتب السلام للاستقدام</span>
                    <br>
                    <u>وعنوانه</u> :
                    <br>
                    حائل - حى النقرة - شارع الامير سعود بن عبد المحسن
                    <br>
                    رقم الهاتف : 0547830004 رقم الفاكس:
                </p>
            </td>
            <td class="english-char">
                <p>
                    Represented in the Kingdom of Saudi Arabia by: <br>
                    Saudi Recruitment Agency : <span class="underline">Peace For Recruitment Agency</span><br>
                    <u>Address: </u> <br> Hail City - Alnoqra Area - Prince Saud Street
                    <br>
                    Tel: 0547830004 Fax:
                </p>
            </td>
        </tr>
    </table>


    <table style="margin-top: 30px; width: 100%">
        <tr>
            <td>
                <h4> ب : إسم العامل / العاملة <?= $worker_info->worker_name_in_arabic; ?></h4>
                المهنة / الوظيفة : <?= $worker_info->job_name_in_arabic; ?>
                <br>
                العنوان فى الفلبين : <?= $this->arabic->en2ar($worker_data->address); ?>
                <br>
                 الحالة الاجتماعية : <?= $worker_data->marital_status == 1 ? 'عزباء' : 'متزوجة'; ?>
                <br>
                أرقام الهواتف : <?= $worker_data->worker_phone; ?>
                <br>
                رقم جواز السفر : <?= $worker_info->passport_number; ?>
                <br>
                <?php
                $time_date_of_issue = DateTime::createFromFormat('d/m/Y', $worker_data->date_of_issue);
                $time_date_of_issue = $time_date_of_issue->getTimestamp();
                ?>
                تاريخ الاصدار : <span style="direction: ltr; display: inline-block;"><?= date('d M,Y', $time_date_of_issue); ?></span>
                <br>
                مكان الاصدار : <?= $this->arabic->en2ar($worker_data->place_of_issue); ?>
                <br>
                إسم أحد الاقارب : <?= $this->arabic->en2ar($worker_data->next_kin_name); ?>
                <br>
                عنوان وأرقام الهواتف لأحد الأقارب
                <br>
                <span><?php echo $worker_data->next_kin_phone . ' / ' . $this->arabic->en2ar($worker_data->next_kin_address); ?></span>
            </td>
            <td class="english-char">
                <h4>B. NAME OF WORKER : <?= $worker_data->name; ?></h4>
                Position : <?= $worker_info->job_name_in_english; ?>
                <br>
                Address in the Philippines : <?= $worker_data->address; ?>
                <br>
                Civil Status : <?= $worker_data->marital_status == 1 ? 'Single' : 'MARRIED'; ?>
                <br>
                Contact Numbers : <?= $worker_data->worker_phone; ?>
                <br>
                Passport Number : <?= $worker_info->passport_number; ?>
                <br>
                Date Of Issue : <?= date('d M,Y', $time_date_of_issue); ?>
                <br>
                Place Of Issue : <?= $worker_data->place_of_issue; ?>
                <br>
                Name Of Next Of Kin : <?= $worker_data->next_kin_name; ?>
                <br>
                Address and Contact Numbers of Next of Kin:
                <br>
                <?php echo $worker_data->next_kin_phone . ' / ' . $worker_data->next_kin_address; ?>
            </td>
        </tr>

        <tr>
            <td>
                <p>
                    ويمثل عنه / عنها فى الفلبين :
                    <br><br>
                    مكتب إرسال العمالة الفلبينية:
                    <br>
                    <?php echo str_replace('Address', '<br>Address', $agent->address ); ?>

                </p>
            </td>
            <td class="english-char">
                <p>
                    Represented in the Philippines by: <br><br>
                    Philippine Recruitment Agency:
                    <br><br>
                    <?php echo str_replace('Address', '<br>Address', $agent->address ); ?>
                </p>
            </td>
        </tr>

        <tr>
            <td>
                وبعد التراضي  قام الطرفان  بالإلتزام  بالبنود  والشروط
                التالية :
            </td>
            <td class="english-char">
                Voluntarily binding themselves to the following terms and conditions:
            </td>
        </tr>

        <tr class="small-text">
            <td>1. موقع العمل: <?= $customer_data->city; ?></td>
            <td class="english-char">1. Site of Employment: <?= $customer_data->english_city; ?></td>
        </tr>

        <tr class="small-text">
            <td>
                2. مدة العقد : سنتين من تاريخ مغادرة العامل / العاملة  من
                الفلبين . ويبدأ الراتب الشهري بعد مباشرة  العمل  بشكل
                فعلي.
            </td>
            <td class="english-char">
                2. Contract Duration: Two  (2) years  effective
                from  the date of departure  of  the worker
                from  the  Philippines. The  monthly  salary
                shall  start  upon actual  reporting  to work.
            </td>
        </tr>

        <tr class="small-text">
            <td>
                3. الراتب الشهري الأساسي :   يتم  إتفاق  صاحب   العمل
                والعامل / العاملة المنزلية على أن يكون الراتب الشهري
                400 دولار أمريكي ،  تمشياً  مع  الأنظمة
                والقوانين المرعية  في كلا  البلدين .
            </td>
            <td class="english-char">
                3. The  Household  Service  Worker  and    the
                employer  agree  on  a  monthly   salary  of
                US $400 which is in  accordance
                with the laws and regulations prevailing in
                both countries.
            </td>
        </tr>

        <tr class="small-text">
            <td>
                4. يقوم صاحب العمل  بفتح  حساب بنكي الخاص  للعامل/
                العاملة المنزلية في المملكة العربية السعودية طبقاً لأنظمة
                وقوانين  مؤسسة  النقد  السعودي  ويقوم   بإيداع   راتب
                العامل / العاملة المنزلية  في نهاية  كل شهر  بإنتظام  في
                الحساب المشار إليه .  ويتم  تسليم  دفتر  الحساب  البنكي
                أو إيصال إيداع  أو ما يعادلهما  للعامل / العاملة  المنزلية
                ويبقى في حوزته / حوزتها .  كما  يقوم   صاحب  العمل
                بتقديم  المساعدة   للعامل / العاملة  المنزلية   في  تحويل
                رواتبه / رواتبها عبر القنوات المصرفية  النظامية .
            </td>
            <td class="english-char">
                4. The employer shall open a bank account  for
                the HSW  in  KSA, subject to SAMA rules and
                regulations and shall deposit regularly every
                end  of  the month the salary of  the HSW to
                the  said  account.  The passbook or  deposit
                slip  or  their equivalent shall be given to the
                HSW   and  remain  in  his/her  custody.  The
                employer   shall   help   the   HSW   to  remit
                his/her    salary    through    proper   banking
                channels.
            </td>
        </tr>

        <tr class="small-text">
            <td>
                5. تمكين  العامل / العاملة  المنزلية  من  راحة  متواصلة
                لا تقل عن (8) ساعات يومياً .
            </td>
            <td class="english-char">
                5. The   Household  Service  Worker  shall   be
                provided  with  continuous  rest  of  at least
                (8)  hours  per day.
            </td>
        </tr>

        <tr class="small-text">
            <td>

                6. يوم راحة : لا يقل عن يوم واحد في الأسبوع .
            </td>
            <td class="english-char">

                6. Rest Day: At least one (1) rest day per week.

            </td>
        </tr>


        <tr class="small-text">
            <td>

                7. النقل المجاني إلى موقع العمل والعودة إلى نقطة الإستقدام
                الأصلية بعد إنتهاء العقد ، وضمان تسفير العامل / العاملة
                في وقته . ويتحمل  صاحب  العمل  تكاليف  سفر وعودة
                العامل / العاملة المنزلية إلى الفلبين في حالة  إلغاء  العقد
                لأسباب لا يرجع إلى العامل / العاملة المنزلية .
            </td>
            <td class="english-char">

                7. Free transportation to  the site  of   employment
                and back to the point of  origin  upon  expiration
                of contract and ensure the worker's  timely
                repatriation. In  case   of    termination    for
                reasons not attributable to the worker,  the
                employer shall bear the cost of repatriation
                of the worker to the Philippines.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                8. يتحمل صاحب  العمل  بتأمين  للعامل / العاملة  المنزلية
                السكن الملائم  والأكل الكافي ،  أو  تعويض  ذلك  ببدل
                مادي .
            </td>
            <td class="english-char">

                8. The employer  shall provide  the Household
                Service Worker, suitable and sanitary living
                quarters  as   well  as    adequate    food   or
                equivalent   monetary   allowance.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                9. يتحمل صاحب العمل التكاليف العلاجية / الطبية لأسباب
                مقبولة  طبياً ويسمح  للعاملة المنزلية  بالراحة ، وتستمر
                في  تقاضي  راتبها  النظامي .

            </td>
            <td class="english-char">

                9. For  acceptable  medical reasons, the HSW
                shall  be allowed  to rest and shall continue
                to receive  his/her  regular   salary.       The
                employer  shall    shoulder   the      medical
                expenses.

            </td>
        </tr>


        <tr class="small-text">
            <td>

                10. للعاملة المنزلية حق العودة  إلى الفلبين  لقضاء  إجازة
                مدفوعة الأجر بمعدل (30) يوماً عن كل سنتين خدمة،
                مع تأمين تذكرة سفر ذهاب وعودة بالدرجة السياحية .
                وفي حالة  الرغبة  في  الإستمرار  في  العمل  فإنها
                تستحق راتب شهر إضافي .

            </td>
            <td class="english-char">

                10. The    HSW  is   entitled  to  return  to    the
                Philippines to spend his/her paid  vacation
                leave   of  thirty  (30)  days  for  every   two
                years of service with a round-trip economy
                class   ticket. In  case  of  his/her  desire  to
                continue  working    with    the    employer,
                he/she    is     entitled     to   an    additional
                one-month salary.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                11. في حالة الوفاة ، يكون  صاحب  العمل  مسئولاً   عن
                ترحيل  جثة  العاملة  المنزلية   ومتعلقاتها  الشخصية
                إلى  الفلبين  بأسرع  ما  يمكن  قانوناً   وبدون  تأخير
                مفرط . وفي حالة  عدم  إمكانية  ترحيل الجثة ، يمكن
                دفنها  بعد الحصول على موافقة  أحد  أقرباء  العاملة
                المنزلية  أو السفارة  الفلبينية .
            </td>
            <td class="english-char">

                11. In   case  of   death,   the        employer   is
                responsible   for  the  repatriation  of   the
                HSW's remains  and  personal  belongings
                to the Republic of the Philippines as  soon
                as   legally   possible   and   without undue
                delay. In  case the repatriation of remains
                is   not   possible,     the    same    may    be
                disposed of  after obtaining   the approval
                of   one   of   the   HSW's   next   of   kin  or
                by the Philippine Embassy.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                12. في  حالة  نشوء  نزاع  بين  صاحب  العمل  والعاملة
                المنزلية ، يمكن  لكلا  طرفي  العقد إحالة  النزاع  إلى
                الجهات  السعودية  المختصة  للتقاضي  والتسوية .
            </td>
            <td class="english-char">

                12. In case  of  dispute between the employer
                and the HSW, the  two contracting parties
                may  refer  the dispute to the appropriate
                Saudi  authorities  for  conciliation  and/or
                resolution.

            </td>
        </tr>

        <tr class="small-text">
            <td>
                13. في حالة هروب العامل / العاملة المنزلية أو رفض
                العمل  دون   أسباب  مقبولة   فإن  مكتب   إرسال
                العمالة  المنزلية  بالفلبيني  يتحمل   تكاليف   تأمين
                بديل   للعامل / العاملة  المنزلية  أو إعادة   تكاليف
                الإستقدام  حسب العقد الموقع  بين  صاحب   العمل
                ومكتب الإستقدام السعودي ومكتب  إرسال  العمالة
                بالفلبين .

            </td>
            <td class="english-char">

                13. In case the Household Service Worker runs
                away  or   refuses   to work   without  valid
                causes, the Philippine recruitment agency
                shall  be  responsible  in  having    him/her
                replaced  or  in returning the accrued cost
                of recruitment to his/her employer, as per
                agreement   between  the   employer,  the
                Saudi    recruitment    agency     and      the
                Philippine  recruitment  agency.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                14. البنود الخاصة :

                أ- ستكون  المسئولية  عن  إشعار  صاحب  العمل  بوصول  العاملة
                المنزلية  في  المملكة  على عائق مكتب  إرسال  العمالة   الفلبينية
                بالتنسيق  مع  مكتب  الاستقدام  السعودي .

            </td>
            <td class="english-char">

                14. Special Provisions:

                a) The   responsibility  of  informing   the employer  regarding  the     departure and    arrival  of   the    HSW  in       the Kingdom of Saudi Arabia shall be that of  the  Philippine recruitment agency  in     coordination      with   the    Saudi recruitment   agency.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                ب- يتعامل صاحب العمل وأفراد أسرته  والعاملة المنزلية  في المملكة
                مع  بعضهم البعض  بمعاملة  حسنة  وبإحترام  وكرامة .
            </td>
            <td class="english-char">

                b) The employer and his family members, and  the HSW shall treat  one   another with  respect  and  dignity.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                ج- تعمل العاملة المنزلية لدى صاحب العمل  ولأعضاء
                أسرته  فقط .
            </td>
            <td class="english-char">

                c) The    HSW  shall  work   solely  for  the employer      and       his       immediate household.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                د- لا يخصم صاحب العمل أي مبلغ  من الراتب النظامي
                للعاملة  المنزلية ، وإن  تم  الخصم  لأسباب   قانونية
                ونظامية فإنه يجب إبراز تلك الخصومات في مسيرات
                رواتب  العاملة .
            </td>
            <td class="english-char">

                d) The   employer  shall  not  deduct  any amount from the regular salary of the Household Service Worker. In case  of deductions  for  lawful  reasons,   such deductions  must  be reflected  in  the HSW's  pay  slip.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                هـ- يقوم  صاحب  العمل  بدفع  رسوم الإقامة  والخروج
                والعودة والخروج النهائي للعاملة  المنزلية ، بالإضافة
                إلى  رسوم  التجديد والغرامات المترتبة على  التأخير .
            </td>
            <td class="english-char">

                e) The  employer shall pay the cost of the Household Service Worker's residence permit (iqama), exit/re-entry visa, and final  exit  visa,  including the renewals and  penalties  resulting  from  delays.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                و- يكون جواز السفر وبطاقة  الإقامة  في حوزة  العاملة
                المنزلية .
            </td>
            <td class="english-char">

                f) The passport and work permit (iqama) of the worker shall  remain  in  his/her possession.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                ز- يسمح  للعاملة  المنزلية   بالإتصال  الهاتفي   بحرية
                بعائلتها  أو بالسفارة أو القنصلية  الفلبينية وذلك على
                حسابها  الشخصي .
            </td>
            <td class="english-char">

                g) The  Household Service  Worker  shall
                be    allowed  to  freely  communicate
                with his/her family and the Philippine
                Embassy / Consulate     on        his/her
                personal expense or account.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                ط- يشرح صاحب العمل فقرات هذا العقد لأفراد أسرته
                والتأكيد لهم بضرورة الإلتزام بها .

            </td>
            <td class="english-char">

                h) The   employer  shall  explain  to    the members    of   his      household    the provisions of this contract and ensure that  these  are  observed.

            </td>
        </tr>

        <tr class="small-text">
            <td>
                15. يمكن تعديل أي فقرة من فقرات هذا العقد القياسي عبر
                اللجنة الفنية السعودية الفلبينية المشتركة .
            </td>
            <td class="english-char">
                15. Any provision of this Standard Employment
                Contract   may   be   altered,   amended    or
                substituted   through  the   Saudi-Philippine
                Joint Technical Working Committee.
            </td>
        </tr>

        <tr class="small-text">
            <td>

                16. في  حالة  نشوب  الحرب  أو  الإضطرابات  المدنية
                أو  وقوع    الكوارث  الطبيعية   أو تعرض  العاملة
                المنزلية لمرض خطير أو الإصابة أثناء العمل والتي
                يثبت طبياً  عدم  قدرتها  على  إكمال  العقد ،   يقوم
                صاحب  العمل بتسفير العاملة المنزلية على حسابه .
            </td>
            <td class="english-char">

                16. The  worker  shall  be   repatriated  at    the
                employer's  expense  in  the event  of  war,
                civil disturbance or major natural calamity,
                or in case the worker suffers from  serious
                illness or work injury medically  proven  to
                render  him/her  incapable  of  completing
                the contract.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                17. بعد إنتهاء العقد ورغبة العاملة المنزلية في العودة  إلى
                الفلبين ، يقوم صاحب العمل بإحضار  كشف  الحساب
                البنكي   الخاص  بالعاملة  المنزلية  لمكتب   الإستقدام
                السعودي ،  ويقوم  صاحب  العمل  والعاملة  المنزلية
                بالتوقيع  على  مخالصة  نهائية . ويمكن  تقديم  كشف
                الحسابات المشار إليه وإثباتات المخالصة كأدلة قاطعة
                في كل من المملكة العربية السعودية وجمهورية الفلبين.
            </td>
            <td class="english-char">

                17. After  the  expiration of  the  contract  and  the
                HSW   desires  to   return    the  Philippines, the
                employer shall present the  bank  statement of
                the HSW to the Saudi recruitment  agency, and
                the employer and the worker shall  then  sign a
                final  settlement. Such  bank   statement     and
                proof  of  settlement    may    be   submitted as
                evidence in the Philippines and  in  the  KSA.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                18. يمكن  تجديد هذا العقد  بالإتفاق  بين  العامل / العاملة
                المنزلية  مع صاحب  العمل . وفي حالة  تجديد العقد
                يتم  تزويد السفارة  أو القنصلية  الفلبينية  بنسخة  من
                بطاقة الإقامة  المجددة   بواسطة  صاحب  العمل  أو
                مكتب  الإستقدام  السعودي .
            </td>
            <td class="english-char">

                18. This   contract   may   be  renewed   upon
                the agreement of the worker and his/her
                employer.     Should    the    contract    be
                renewed, a  copy of  the renewed iqama
                shall   be  submitted   to   the   Philippine
                Embassy/Consulate by  the  employer or
                Saudi recruitment agency.

            </td>
        </tr>

        <tr class="small-text">
            <td>

                19. حرر هذا العقد من نسختين أصليتين باللغة  الإنجليزية
                والعربية ، ويتم  الإعتماد  عليهما  والعمل  بموجبهما
                بالتساوي .
            </td>
            <td class="english-char">

                19. This   contract   shall    be  written  in   two
                original  copies  in  the English and  Arabic
                text, both copies being equally authentic.

            </td>
        </tr>

        <tr>
            <td style="text-align: center" class="extra-padding">
                Name of Employer
                and Signature
                <br>
                إسم وتوقيع صاحب العمل
            </td>
            <td style="text-align: center" class="extra-padding">
                Name of Household Service Worker
                and Signature
                <br>
                إسم وتوقيع العامل/ العاملة المنزلية
            </td>
        </tr>

        <tr class="extra-padding">
            <td style="text-align: center" class="extra-padding">
                Saudi Recruitment Agency
                <br>
                مكتب الإستقدام السعودي
            </td>
            <td style="text-align: center;" class="extra-padding">
                Philippine Recruitment Agency
                <br>
                مكتب إرسال العمالة الفلبينية
            </td>
        </tr>

    </table>



</div><!-- ./ contract-wrapper -->


</body>
</html>