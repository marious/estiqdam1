<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
      .images-wrapper {
          width: 600px;
          margin: 0 auto;
      }  
        .img-container {
            width: 200px;
            height: 200px;
            float: left;
        }
        .img-container img {
            display: block;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }
        p {
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="images-wrapper">
        <div class="img-container">
            <?php if ($contract->contract_image != '0'): ?>
                <a href="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->contract_image); ?>" target="_blank">
                    <img src="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->contract_image); ?>" alt="">
                </a>
                <p>Contract Image <a href="<?= site_url('agent_worker/download/' . $contract_number . '/Contract/?file=' . urlencode($contract->contract_image)); ?>">Download</a></p>
            <?php endif; ?>

            <?php if ($contract->id_image != '0'): ?>
                <a href="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->id_image); ?>" target="_blank">
                    <img src="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->id_image); ?>" alt="">
                </a>
                <p>ID Image <a href="<?= site_url('agent_worker/download/' . $contract_number . '/Contract/?file=' . urlencode($contract->id_image)); ?>">Download</a></p>
            <?php endif; ?>

            <?php if ($contract->delegation_image != '0'): ?>
                <a href="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->delegation_image); ?>" target="_blank">
                    <img src="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->delegation_image); ?>" alt="">
                </a>
                <p>Delegation Image <a href="<?= site_url('agent_worker/download/' . $contract_number . '/Contract/?file=' . urlencode($contract->delegation_image)); ?>">Download</a></p>
            <?php endif; ?>

            <?php if ($contract->passport_image != ''): ?>
                <?php $passport_img = site_url('assets/img/workers/' . $contract->agent_worker_passport_image); ?>
                <a href="<?= $passport_img; ?>" target="_blank">
                    <img src="<?= $passport_img; ?>" alt="">
                </a>
            <p>Passport Image <a href="<?= site_url('agent_worker/download2/' . $contract->agent_worker_passport_image. '/?file=' . urlencode($contract->agent_worker_passport_image)); ?>">Download</a></p>
            <?php endif; ?>

            <?php if ($contract->visa_image != '0'): ?>
                <a href="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->visa_image); ?>" target="_blank">
                    <img src="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->visa_image); ?>" alt="">
                </a>
                <p>Visa Image <a href="<?= site_url('agent_worker/download/' . $contract_number . '/Contract/?file=' . urlencode($contract->visa_image)); ?>">Download</a></p>
            <?php endif; ?>

            <?php if ($contract->ticket_image != '0'): ?>
                <a href="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->ticket_image);  ?>" target="_blank">
                    <img src="<?= site_url('assets/contracts/' . $contract_number . '/' . $contract->ticket_image); ?>" alt="">
                </a>
                <p>Ticket Image <a href="<?= site_url('agent_worker/download/' . $contract_number . '/Ticket_Image/?file=' . urlencode($contract->ticket_image)); ?>">Download</a></p>
            <?php endif; ?>





        </div>
    </div>
</body>
</html>