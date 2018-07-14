<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= site_url('assets/css/imageareaselect.css'); ?>">

</head>
<body>

<div class="container-fluid">


    <div class="row">
        <div class="col-md-7" style="margin-top: 20px;">
            <p><img style="display: none;" id="filePreview"></p>
            <form action="<?= site_url('crop_image/crop'); ?>" method="post">
                <input type="hidden" name="x" id="x">
                <input type="hidden" name="y" id="y">
                <input type="hidden" name="w" id="w">
                <input type="hidden" name="h" id="h">
                <input type="hidden" name="imgSrc" id="imgSrc">
                <input type="submit" value="Submit" name="crop">
            </form>
        </div>

        <div class="col-md-5">

            <form method="get" class="form-inline" style="margin: 30px 0;" action="<?= site_url('crop_image/get_maid'); ?>">
                <div class="input-group">
                    <input type="text" placeholder="type maid number" class="form-control" name="worker_number">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <div class="panel panel-default ">
                <div class="panel-heading">Workers </div>
                <div class="panel-body">
                    <?php if ($pagination): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="60%">Image</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="userData">
                        <?php if(!empty($workers)): foreach($workers as $worker): ?>
                            <tr>
                                <form method="post" action="<?= site_url('crop_image/update_image_name'); ?>">
                                <td><?php echo '#'.$worker['id']; ?></td>
                                <td><input type="text" value="<?php echo $worker['image']; ?>" style="display: block; width: 100%;" name="image"></td>
                                <td class="img-container">
                                    <div style="width: 80px;">
                                        <a>
                                            <img src="<?= site_url('assets/img/workers/'  .$worker['image']) ?>" alt="" class="img-responsive" style="height: 100px;">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="id" value="<?= $worker['id']; ?>">
                                    <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                </td>
                                </form>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="3">Worker(s) not found......</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php else: ?>


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="60%">Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="userData">
                            <?php if(!empty($worker)): ?>
                                <tr>
                                    <form method="post" action="<?= site_url('crop_image/update_image_name'); ?>">
                                        <td><?php echo '#'.$worker['id']; ?></td>
                                        <td><input type="text" value="<?php echo $worker['image']; ?>" style="display: block; width: 100%;" name="image"></td>
                                        <td class="img-container">
                                            <div style="width: 80px;">
                                                <a>
                                                    <img src="<?= site_url('assets/img/workers/'  .$worker['image']) ?>" alt="" class="img-responsive" style="height: 100px;">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="id" value="<?= $worker['id']; ?>">
                                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php else: ?>
                                <tr><td colspan="3">Worker(s) not found......</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div><a href="<?= site_url('crop_image') ?>">All Workers</a></div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- render pagination links -->
            <ul class="pagination pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </ul>
        </div>
    </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?= site_url('assets/js/jquery.imgareaselect.js') ?>"></script>
<script>
    $('#userData').on('click', 'td.img-container img', function(e) {
        e.preventDefault();
        var src = $(this).attr('src');
        var filePreview = $('#filePreview');
        $('#imgSrc').val(src);
        filePreview.attr('src', src);
        filePreview.fadeIn();
    });


    // Set image coordinates
    function updateCoords(im, obj) {
        $('#x').val(obj.x1);
        $('#y').val(obj.y1);
        $('#w').val(obj.width);
        $('#h').val(obj.height);
    }


    // Check Coordinates
    function checkCoords() {
        if (parseInt($('#w').val())) return true;
        alert("Please select a crop region then press submit.");
        return false;
    }


    // implement imgArea select plugin
    $('img#filePreview').imgAreaSelect({
        onSelectEnd: updateCoords
    });


</script>

</body>
</html>