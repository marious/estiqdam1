<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
      <meta name="description" content="مكتب السلام للاستقدام نقدم خدمة استقدام العمالة المنزلية بأسعار مغرية ،نتميز بسرعة الاسنقدام ، مكتب معتمد من مساند برنامج العمالة المنزلية">
      <meta name="language" content="Arabic">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="keywords" content="استقدام , عمالة منزلية ,  عاملة منزلية , خادمة , سائق خاص , مساند">
      <meta name="title" content="Https://peace4r.com">
      <meta name="revisit-after" content="1 days">
      <meta property="og:locale" content="ar_AR">
      <meta property="og:locale:alternate" content="en_GB">
      <meta property="og:type" content="website">
      <meta property="og:title" content="مكتب السلام للاستقدام استقدام خادمة عاملة منزلية">
      <meta property="og:description" content="استقدام العمالة المنزلية">
      <meta property="og:url" content="https://peace4r.com/">
      <meta property="og:image" content="<?= site_url('assets/img/small_logo.png'); ?>">
      <meta property="og:site_name" content="مكتب السلام للإستقدام">
      <link rel="shortcut icon" href="<?= site_url('assets/img/'); ?>favicon.ico" type="image/x-icon">
      <link rel="icon" href="<?= site_url('assets/img/'); ?>favicon.ico" type="image/x-icon">
      <link rel="alternate" hreflang="ar-SA" href="https://peace4r.com/">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <?php
      $language = isset($_SESSION['public_site_language']) ? $_SESSION['public_site_language'] : 'arabic';
      ?>
      <?php if ($language == 'arabic'): ?>
      <link rel="stylesheet" href="https://cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
      <?php endif; ?>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?= site_url('assets/js/select2/dist/css/select2.min.css'); ?>">
      <link rel="stylesheet" href="<?= site_url('assets/css/style.css') . '?v=' . filemtime(FCPATH . 'assets/css/style.css'); ?>">
      <link rel="stylesheet" href="<?= site_url('assets/css/peacer.css') . '?v=' . filemtime(FCPATH . 'assets/css/peacer.css') ; ?>">
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113323414-1"></script>
      <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-113323414-1');

      </script>

  </head>

  <body direction="rtl">

  <div class="header navbar navbar-default">
      <div class="container">
          <h1 style="color: #C54747; text-align: center; font-size: 40px;">برنامج الاستقدام الشامل</h1>
          <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="<?= site_url('assets/img/nav_icon.png'); ?>" alt="" /> </a>
          </div>
      </div>
  </div>



      <?php
      if (isset($page->page_content)) {
        echo nl2br($page->page_content);

        if ($page->page_url == '') {

        }

      } else if (isset($view_file)) {
          $this->load->view($view_module . '/' . $view_file);
        }
     ?>
      



<!--  <div class="footer">-->
<!--      <div class="footer_bottom">-->
<!--          <div class="follow-us">-->
<!--              <a class="fa fa-facebook social-icon" href="https://www.facebook.com/profile.php?id=100009223012865" title="Facebook Page" target="_blank"></a>-->
<!--              <a class="fa fa-twitter social-icon" href="https://twitter.com/Upeacet" target="_blank" title="Twitter Page"></a>-->
<!--              <a class="fa fa-youtube social-icon" href="https://www.youtube.com/channel/UCAd74izRxuMkA5UsTEQ0xnA?view_as=subscriber" title="Youtube Page" target="_blank"></a> </div>-->
<!--          <div class="copy">-->
<!--              <p>Copyright &copy; --><?//= date('Y'); ?><!-- Peace For Recruitment</p>-->
<!--          </div>-->
<!--      </div>-->
<!--  </div>-->



  <!-- Bootstrap core JavaScript
  ================================================== -->
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?= site_url('assets/js/responsive-nav.js'); ?>"></script>
    <script src="<?= site_url('assets/js/select2/dist/js/select2.min.js'); ?>"></script>
  <?php if (isset($img_preview) && $img_preview == true): ?>
      <script src="<?= site_url('assets/js/imgPreview.min.js') ?>"></script>
      <script>
           // $.imgPreview();
           $.imgPreview({
               el: '[data-pic]',
               attr: 'data-pic',
               attrTitle: 'data-pic-title',
               attrDesc: 'data-pic-desc',
               mode: 'single',
               isMaskShow: true,
               maskBgColor: 'rgba(0,0,0,.5)'
           });
      </script>
  <?php endif; ?>

  <script>
  var root = "<?= base_url(); ?>";
  </script>

  <?php if (isset($js_files)): ?>
      <?php foreach ($js_files as $js_file): ?>
          <script src="<?php echo site_url($js_file) . '?v=' . filemtime(FCPATH . $js_file); ?>"></script>
      <?php endforeach; ?>
  <?php endif; ?>

    <script>
        //$.fn.select2.defaults.set("theme", "bootstrap");
//        $.fn.select2.defaults.set("width", null);
//        $('.select2-field').select2({
//            dir: "rtl",
//        });
//        $('.select2-field').parent().find('.select2-container').css('width', '');


    </script>

  </body>
</html>
