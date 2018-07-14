<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            direction: rtl;
            font-family: serif;
            font-size: 13px;
        }
        table {
            border: 1px solid #333;
            border-collapse: collapse;
            width: 1000px;
        }
        h1 {
            page-break-before: always;
            page-break-after: avoid;
            text-align: center;
        }
        th, td {
            padding: 4px;
            text-align: center;
            border-left: 1px solid #333;
        }
        th {
            border-top: 1px solid #333;
            border-bottom: 2px solid #333;
            font-size: 12px;
        }
        td {
            border-bottom: 1px solid #333;
        }
        @page {
            /*size: A4;*/
        }
        table,figure {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

<?php if ($services && count($services)): ?>
    <h1> التقرير اليومى ليوم <?= $_GET['contract_date'] ?></h1>
    <table id="services_table" class="table table-bordered table-striped services-table">
        <thead>
        <tr>
            <th width="2%">الرقم</th>
            <th width="28%">اسم العميل</th>
            <th width="10%">جهة القدوم</th>
            <th width="10%">المهنة</th>
            <th width="8%">رقم التأشيرة</th>
            <th width="8%">رقم الهوية</th>
            <th width="8%">نوع الطلب</th>
            <th width="10%">رقم الطلب</th>
            <th width="12%">وكيل الاستقدام</th>
            <th>البطاقة</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach ($services as $service): ?>

            <tr>
                <td><?php echo $i; $i++; ?></td>
                <td><?php echo $service->customer_name_in_arabic; ?></td>
                <td><?php echo $service->city; ?></td>
                <td><?php echo $service->job_name_arabic; ?></td>
                <td><?php echo $service->visa_number; ?></td>
                <td><?php echo $service->customer_id; ?></td>
                <td><?php echo $service->order_name_arabic; ?></td>
                <td><?php echo $service->order_number; ?></td>
                <td><?php echo $service->representative_name; ?></td>
                <td><?php echo $service->credit_card; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h2><?= lang('no_service'); ?></h2>
<?php endif; ?>

<script>
    window.print();
</script>
</body>
</html>