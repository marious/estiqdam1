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
        }
        .wrapper {
            width: 960px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 8px 20px 50px;
        }
        header {
            overflow: auto;
        }
        p {
            font-size: 18px;
            line-height: 1.5;
        }
        header p {
            width: 40%;
            float: right;
            font-size: 24px;
        }
        header p:last-of-type {
            float: left;
        }
        .clearfix {
            clear: both;
        }
        h3 {
            font-size: 32px;
            font-weight: normal;
            text-align: center;
        }
        table {
            width: 100%;
            /*border: 1px solid #000;*/
            border-collapse: collapse;
        }
        td{
            border: 1px solid #000;
            border-bottom: none;
        }
        table:last-of-type td {
            border-bottom: 1px solid #000;
        }
        tr td:first-child {
            width: 150px;
        }
        td {
            padding: 5px;
        }
        td.test {
            width: 500px;
        }
        div.documents {
            width: 100%;
            border: 1px solid #000;
            padding: 5px;
            margin-top: 40px;
            overflow: auto;
            height: 400px;
        }
        div.documents div.id-photo {
            width: 60%;
            float: right;
        }
        div.documents div.sign {
            width: 35%;
            float: left;
            border-right: 1px solid #000;
            height: 400px;
            padding-right: 5px;
        }
        h4 {
            font-weight: normal;
            font-size: 24px;
        }
    </style>
</head>
<body direction="rtl">
   <div class="wrapper">
       <header>
           <p>التاريخ: </p>
           <p>الموافق:</p>
           <div class="clearfix"></div>
           <h3>إلغاء تفويض عمالة منزلية</h3>
       </header>
       <table>
           <tr>
               <td>أسم صاحب العمل</td>
               <td><?= $customer_name; ?></td>
           </tr>
       </table>
       <table>
           <tr style="text-align: center;">
               <td style="text-align: right;">رقم الصادر</td>
               <td><?= $visa_number[9]; ?></td>
               <td><?= $visa_number[8]; ?></td>
               <td><?= $visa_number[7]; ?></td>
               <td><?= $visa_number[6]; ?></td>
               <td><?= $visa_number[5]; ?></td>
               <td><?= $visa_number[4]; ?></td>
               <td><?= $visa_number[3]; ?></td>
               <td><?= $visa_number[2]; ?></td>
               <td><?= $visa_number[1]; ?></td>
               <td><?= $visa_number[0]; ?></td>
           </tr>
       </table>
       <table>
           <tr>
               <td>السجل المدنى</td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
           </tr>
       </table>
       <table>
           <tr>
               <td>جهة القدوم</td>
               <td></td>
           </tr>
       </table>
       <table>
           <tr style="text-align: center;">
               <td style="text-align: right;">رقم الجوال</td>
               <?php $mobile = $customer_mobile; ?>
               <td><?= $mobile[9]; ?></td>
               <td><?= $mobile[8]; ?></td>
               <td><?= $mobile[7]; ?></td>
               <td><?= $mobile[6]; ?></td>
               <td><?= $mobile[5]; ?></td>
               <td><?= $mobile[4]; ?></td>
               <td><?= $mobile[3]; ?></td>
               <td><?= $mobile[2]; ?></td>
               <td><?= $mobile[1]; ?></td>
               <td><?= $mobile[0]; ?></td>
           </tr>
       </table>


       <h3>إقرار صاحب العمل</h3>

       <p>السادة/ مكتب السلام للاستقدام</p>
       <p>
           أنا الموقع أدناه فوضت مكتبكم بإلغاء تفويض عمالة منزلية حسب بيانات التأشيرة أعلاها ولكم الحق فى التوقيع نيابة عنى فى ما يخص الإجراءات المتبعة بهذا الشأن
       </p>

       <div class="documents">
           <div class="id-photo">
               <h4>صورة الهوية الوطنية</h4>
           </div>
           <div class="sign">
               <h4>توقيع صاحب الطلب أو الوكيل الشرعى</h4>
           </div>
       </div>

   </div>
</body>
</html>