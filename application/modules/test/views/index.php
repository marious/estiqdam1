<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: myFont;
            src: url(<?= site_url('assets/fonts/droidkufi-regular.woff') ?>);
        }
        body {
            direction: rtl;
            font-family: myFont;
        }
        h1 {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        div.table-wrapper {
            width: 960px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }
        th {
            background-color: #f2f2f2;
            color: #000;
        }
        td {
            /*background-color: #f3f3f3;*/
            color: #000;
        }
        th, td {
            border: 1px solid #000;
        }
        td {
            padding: 4px;
        }
        input {
            display: block;
            width: 100%;
            height: 30px;
            font-size: 18px;
            padding-right: 4px;
            box-sizing: border-box;
        }

    </style>
</head>
<body>

    <h1>بيانات العقد</h1>
   <div class="table-wrapper">
       <table>
           <tr>
               <th>رقم العقد</th>
               <td>15</td>
           </tr>
           <tr>
               <th>اسم العميل</th>
               <td>محمد ابراهيم عبدالله</td>
           </tr>
           <tr>
               <th>رقم الهوية</th>
               <td>12345</td>
           </tr>
           <tr>
               <th>رقم التأشيرة</th>
               <td>1475225</td>
           </tr>
           <tr>
               <th>اسم العامل / العاملة</th>
               <td>Aisha Ahmed</td>
           </tr>
           <tr>
               <th>المهنة</th>
               <td>عاملة منزلية</td>
           </tr>
           <tr>
               <th>نوع الطلب</th>
               <td>تصديق</td>
           </tr>
           <tr>
               <th>رقم الطلب</th>
               <td></td>
           </tr>
           <tr>
               <th>اسم المندوب</th>
               <td>ابو فيصل</td>
           </tr>
           <tr>
               <th>مكتب الاستقدام</th>
               <td>هارونا</td>
           </tr>
           <tr>
               <th>المسوق</th>
               <td>ابو فهد</td>
           </tr>
           <tr>
               <th>تكلفة الاستقدام</th>
               <td>12500</td>
           </tr>
           <tr>
               <th>المبلغ المدفوع</th>
               <td>5500</td>
           </tr>
           <tr>
               <th>المبلغ المتبقى</th>
               <td>7000</td>
           </tr>
           <tr>
               <th>بطاقة الائتمان</th>
               <td>2245</td>
           </tr>
           <tr>
               <th>تاريخ التفويض</th>
               <td></td>
           </tr>
           <tr>
               <th>تاريخ التفييز</th>
               <td>
                   <input type="text">
               </td>
           </tr>
           <tr>
               <th>تاريخ الوصول</th>
               <td>
                   <input type="text">
               </td>
           </tr>
           <tr>
               <th>مطار الوصول</th>
               <td>حائل</td>
           </tr>
       </table>
   </div>
</body>
</html>