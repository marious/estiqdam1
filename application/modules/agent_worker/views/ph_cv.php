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
            margin: 0;
            padding: 0;
        }
        .container {
            width: 1000px;
            margin-top: 5cm;
            margin-left: auto;
            margin-right: auto;
        }
        h2 {
            text-align: center;
            font-size: 28px;
        }
        table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
        }
        table, tr {
            /*border: 1px solid #000;*/
        }
        table td {
            width: 30%;
            padding: 5px;
            box-sizing: border-box;
            text-align: center;
        }
        td {
            border: 1px solid #000;
        }
        table th {
            width: 70%;
            border: 1px solid #000;
            text-align: left;
            padding-left: 14px;
        }
        div.passport-img {
            overflow: hidden;
            margin-top: 30px;
            width: 100%;
        }
        div.passport-img img {
            /*max-width: 80%;*/
            width: 70%;
            display:block;
            height: 600px;
            /*text-align: center;*/
            /*margin: 0 auto;*/
            margin: 0 auto;
            margin-top: -250px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>HOUSEMAID INFORMATION SHEET</h2>
        <table>
            <tr>
                <td>NAME</td>
                <th><?= $worker->name;?></th>
            </tr>
            <tr>
                <td>AGE</td>
                <th><?php echo calculate_age($worker->date_of_birth); ?></th>
            </tr>
            <tr>
                <td>DATE OF BIRTH</td>
                <?php
                $date_of_birth = date('F j, Y', strtotime(str_replace('/', '-', $worker->date_of_birth)));
                ?>
                <th><?php echo $date_of_birth; ?></th>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <th><?php echo $worker->address; ?></th>
            </tr>
            <tr>
                <td>CONTACT NUMBER</td>
                <th><?php echo $worker->worker_phone; ?></th>
            </tr>
            <tr>
                <td>NATIONALITY</td>
                <th>FILIPINO</th>
            </tr>
            <tr>
                <td>RELIGION</td>
                <th><?= get_religion($worker->religion); ?></th>
            </tr>
            <tr>
                <td>STATUS</td>
                <th><?php echo get_marital_status($worker->marital_status); ?></th>
            </tr>
            <tr>
                <td>EDUCATION</td>
                <th><?= $worker->qualification; ?></th>
            </tr>
            <tr>
                <td>PASSPORT NUMBER</td>
                <th><?= $worker->passport_number; ?></th>
            </tr>
            <tr>
                <td>DATE OF ISSUE</td>
                <?php $date_of_issue = date('F j, Y', strtotime(str_replace('/', '-', $worker->date_of_issue)))  ?>
                <th><?php echo $date_of_issue; ?></th>
            </tr>
            <tr>
                <td>DATE OF EXPIRY</td>
                <?php
                $date_of_expiry = date('F j, Y', strtotime(str_replace('/', '-', $worker->date_of_expiry)));
                ?>
                <th><?= $date_of_expiry; ?></th>
            </tr>
            <tr>
                <td>PLACE OF ISSUE</td>
                <th><?= $worker->place_of_issue; ?></th>
            </tr>
            <tr>
                <td>NEXT OF KIN</td>
                <th><?= $worker->next_kin_name; ?></th>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <th><?= $worker->next_kin_address; ?></th>
            </tr>
            <tr>
                <td>CONTACT NUMBER</td>
                <th><?= $worker->next_kin_phone; ?></th>
            </tr>
        </table>
        <div class="passport-img">
            <img src="<?= site_url('assets/img/workers/' . $worker->passport_image) ?>" alt="">
        </div>
    </div>
</body>
</html>