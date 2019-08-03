<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() . '/assets/admin/'; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() . '/assets/admin/'; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() . '/assets/admin/'; ?>bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url() . '/assets/admin/'; ?>bower_components/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url() . 'assets/admin/'?>bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() . '/assets/admin/'; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() . '/assets/admin/'; ?>dist/css/skins/_all-skins.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,700&display=swap" rel="stylesheet">


    <?php if (isset($css_file)): ?>
  <?php if (is_array($css_file)): ?>
  <?php foreach ($css_file as $file): ?>
  <link rel="stylesheet" href="<?= $file; ?>?v=<?= filemtime(FCPATH . '/' . substr($file, strpos($file, 'assets'))) ?>">
  <?php endforeach; ?>
  <?php else: ?>
  <link rel="stylesheet" href="<?= $css_file; ?>?v=<?= filemtime(FCPATH . '/' . substr($css_file, strpos($css_file, 'assets'))) ?>">
  <?php endif; ?>
  <?php endif; ?>

    <?php if (isset($css_cdn)): ?>
    <?php foreach ($css_cdn as $file): ?>
            <link rel="stylesheet" href="<?= $file; ?>">
    <?php endforeach; ?>
    <?php endif; ?>

    <link rel="stylesheet" href="<?= base_url().'/assets/admin/css/style.css?v' . filemtime(FCPATH . '/'.'assets/admin/css/style.css'); ?>">

    <script src="<?= base_url() . '/assets/admin/'; ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() . '/assets/admin/'; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</head>