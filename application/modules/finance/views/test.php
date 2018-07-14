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
            src: url(<?= site_url('assets/fonts/KacstOne.ttf') ?>);
        }
        body {
            direction: rtl;
            font-family: myFont;
            font-size: 18px;
        }
        div.wrapper{
            width: 90%;
            margin: 5px auto;
        }
        h1 {
            text-align: center;
            font-weight: normal;
        }
        h2 {
            text-align: center;
            font-weight: normal;
        }
        div.date-amount {
            overflow: hidden;
            width: 100%;
        }
        div.amount {
            width: 35%;
            float: right;
            padding: 10px 15px 10px 15px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            text-align: left;
            font-size: 20px;
        }
        div.date {
            width: 35%;
            float: right;
            margin-right: 200px;
            padding: 10px 15px 10px 15px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            text-align: right;
            font-size: 20px;
        }
        div.content {
            margin-top: 50px;
        }
        div.content p {
            font-size: 20px;
            line-height: 2em;
        }
        @media print {
            div.date {
                margin-right:150px;
            }
            h1 {
                margin-top: 0;
                padding-top: 0;
            }
            div.content {
                margin-top: 100px;
            }
            div.footer {
                font-size: 16px;
                position: absolute;
                bottom: 0;
            }
        }

    </style>
</head>
<body>
<h1>بسم الله الرحمن الرحيم</h1>
<h2>سند قبض</h2>

    <div class="wrapper">
        <div class="date-amount">
            <div class="amount"> <?= $amount; ?> ريال</div>
            <div class="date">التاريخ: <?= $payment_date; ?></div>
        </div>
        <div class="content">
            <p>
                استلمنا من المكرم / <?= $customer_name; ?><br>
                مبلغ <?= $amount; ?>  ريال لا غير   <br>
                على بنك      وذلك مقابل استقدام  <br>
                من دولة
            </p>
        </div>
    </div>
<div class="footer">
<p>
    حائل - حى النقرة - شارع الامير سعود الشريان ج/0541566633 / ج/ 0547830004 / ايميل : peacer2017@gmail.com
</p>
</div>

<script>window.print();</script>
</body>
</html>