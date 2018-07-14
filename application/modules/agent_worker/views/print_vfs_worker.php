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
            font-size: 14px;
        }
        table {
            border: 1px solid #333;
            border-collapse: collapse;
            width: 1000px;
        }
        h1 {
            /*page-break-before: always;*/
            /*page-break-after: avoid;*/
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
            font-size: 13px;
        }
        td {
            border-bottom: 1px solid #333;
        }
        @page {
            /*size: A4;*/
        }
        table,figure {
            /*page-break-inside: avoid;*/
        }
    </style>
</head>
<body>

<?php if ($workers && count($workers)): ?>
    <h1><?= $title; ?> </h1>
    <table id="services_table" class="table table-bordered table-striped services-table">
        <thead>
        <tr>
            <th width="2%">#</th>
            <th width="15%">اسم العاملة</th>
            <th width="15%">اسم العميل</th>
            <th width="10%">المكتب الاجنبى</th>
            <th width="10%">تاريخ استلام العقد</th>
            <th width="8%">تاريخ ال VFS</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach ($workers as $worker): ?>

            <tr>
                <td><?php echo $i; $i++; ?></td>
                <td><?= $worker->worker_name_in_english; ?></td>
                <td><?= $worker->customer_name_in_arabic; ?></td>
                <td><?= $worker->agent_name; ?></td>
                <td>
                    <?php if ($worker->contract_received_date) { echo strpos($worker->contract_received_date, '/')  ?
                        DateTime::createFromFormat('d/m/Y', $worker->contract_received_date)->format('d/m/Y') : date('d/m/Y', strtotime($worker->contract_received_date));} else {echo '';}; ?>
                </td>
                <td>
                    <?php if ($worker->biometric_date){ echo  strpos($worker->biometric_date, '/') ? DateTime::createFromFormat('d/m/Y', $worker->biometric_date)->format('d/m/Y') : date('d/m/Y', strtotime($worker->biometric_date)); }else {echo '';};?>
                </td>
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