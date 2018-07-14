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
            font-size: 12px;
        }
        table {
            border: 1px solid #333;
            border-collapse: collapse;
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
        }
        td {
            border-bottom: 1px solid #333;
        }
        table,figure {
            page-break-inside: avoid;
        }
        .container {
            width: 1000px;
            margin: 0 auto;
        }
        h1 {
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">
<?php if ($info && count($info)): ?>
    <?php
    if ($agent == '') { $agent_name = 'كل المكاتب'; } else {$agent_name = $info[0]->agent_name;}
    if (in_array($representative, array('1', '0'))) {
        $representative_name = 'كل المكاتب';
    }
    else {
        $representative_name = $info[0]->representative_name;
    }
    ?>
    <h1>تقرير عن مكتب استقدام: <?= $info[0]->representative_name; ?> والمكتب الاجنبى : <?= $agent_name; ?> فى الفترة <?= $when; ?></h1>
    <table id="services_table" class="table table-bordered table-striped services-table">
        <thead>
        <tr>
            <th width="2%">#</th>
            <th width="15%">تاريخ العقد</th>
            <th width="25%">اسم العميل</th>
            <th width="12%">جوال العميل</th>
            <th width="10%">مكتب الاستقدام</th>
            <th width="8%">تكلفة الاستقدام</th>
            <th width="8%">المبلغ المدفوع</th>
            <th width="8%">المبلغ المتبقى</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php
        $totalPrepaid = 0;
        $total_remains = 0;
        ?>
        <?php foreach ($info as $data): ?>
            <?php
            $totalPrepaid += $data->prepaid_money;
            $total_remains += $data->remains_money;
            ?>

            <tr>
                <td><?= $i; ?></td>
                <td><?= date('d-m-Y', strtotime($data->contract_date)); ?></td>
                <td><?= $data->customer_name_in_arabic;  ?></td>
                <td><?= $data->customer_mobile;  ?></td>
                <td><?= $data->representative_name; ?></td>
                <td><?= $data->recruitment_cost; ?></td>
                <td><?= $data->prepaid_money; ?></td>
                <td><?= $data->remains_money; ?></td>
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h2>لا توجد بيانات لعرضها</h2>
<?php endif; ?>
</div>
<script>
    window.print();
</script>
</body>
</html>