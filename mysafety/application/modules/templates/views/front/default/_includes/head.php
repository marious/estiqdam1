<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : setting(make_trans('meta_description')); ?>">
  <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : setting(make_trans('meta_keywords')); ?>">
  <title><?php echo lang('safety_point')  ?> | <?php if (isset($page_header)) echo $page_header; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= site_url('assets/css/animate.css') ?>">
  <link rel="stylesheet" href="<?= site_url('assets/css/colors.css'); ?>">

  <?php if (isset($css_file)): ?>
  <?php if (is_array($css_file)): ?>
  <?php foreach ($css_file as $file): ?>
  <link rel="stylesheet" href="<?= $file; ?>">
  <?php endforeach; ?>
  <?php else: ?>
  <link rel="stylesheet" href="<?= $css_file; ?>">
  <?php endif; ?>
  <?php endif; ?>
  


  <?php if (get_current_front_lang() == 'en') : ?>
  <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css?v=') . filemtime(FCPATH . '/assets/css/custom.css')?>">
  <?php endif; ?>
  <?php if (get_current_front_lang() == 'ar'): ?>
  <link rel="stylesheet" href="https://cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="<?= site_url('assets/css/custom_ar.css?v=') . filemtime(FCPATH . '/assets/css/custom_ar.css') ?>">
  <?php endif; ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  
