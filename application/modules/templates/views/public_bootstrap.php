<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مكتب السلام للاستقدام</title>
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
      <div class="container"> <a class="navbar-brand pull-right" href="<?= site_url(); ?>"><img src="<?= site_url('assets/img/peace_logo.png'); ?>" class="site-logo"></a>
          <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="<?= site_url('assets/img/nav_icon.png'); ?>" alt="" /> </a>
              <ul class="nav" id="nav">
                  <li><a href="<?= site_url('home'); ?>"><?= lang('home'); ?></a></li>

                  <li><a href="<?= site_url('home/contact'); ?>"><?= lang('contact_us'); ?></a></li>
                  <li><a href="<?= site_url('home/tanazul'); ?>">للتنازل</a></li>
                  <?php
                  $this->load->module('seo_pages');
                  $seo_pages = $this->seo_pages->Seo_pages_model->get_column(null, 'title');
                  if ($seo_pages && count($seo_pages)) {
                      foreach ($seo_pages as $seo_page) {
                          $seo_page_url  = 'home/seo_pages/' . url_title($seo_page->title);
                          echo "<li class=\"seo_page_purpose\"><a href='$seo_page_url'>{$seo_page->title}</a></li>";
                      }
                  }
                  ?>

                  <!-- Authentication Links -->
                  <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
                      <li>
                          <a href="<?= site_url('home/customer_favorite_list') ?>">
                              قائمة التفضيلات
                          </a>
                      </li>
                      <li>
                          <a href="<?= site_url('home/demand_list'); ?>">قائمة الطلبات</a>
                      </li>
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle parent" data-toggle="dropdown" role="button" aria-expanded="false">
                              <?= $_SESSION['username'] ?> <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                              <li>
                                  <a href="<?= site_url('home/change_password'); ?>">تغيير الرقم السرى</a>
                              </li>

                              <li>
                                  <a href="#" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="parent">
                                      تسجيل الخروج
                                  </a>

                                  <form id="logout-form" action="<?= site_url('site_security/logout_customer'); ?>" method="POST" style="display: none;">
                                  </form>
                              </li>
                          </ul>
                      </li>
                  <?php else: ?>
                  <li><a href="<?= site_url('home/login'); ?>"><?= lang('register'); ?></a></li>
<!--                  <li><a href="http://buildingsite.dev/register">تسجيل عضوية جديدة</a></li>-->
                  <?php endif; ?>
                  <?php if (isset($_SESSION['public_site_language']) && $_SESSION['public_site_language'] == 'english'): ?>
                      <li><a href="<?= site_url('home/lang/arabic') ?>">AR</a></li>
                  <?php else: ?>
                      <li><a href="<?= site_url('home/lang/english') ?>">EN</a></li>
                  <?php endif; ?>
                  <div class="clear"></div>
              </ul>
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
      



  <div class="footer">
      <div class="footer_bottom">
          <div class="follow-us">
              <a class="fa fa-facebook social-icon" href="https://www.facebook.com/profile.php?id=100009223012865" target="_blank"></a>
              <a class="fa fa-twitter social-icon" href="https://twitter.com/Upeacet" target="_blank"></a>
              <a class="fa fa-youtube social-icon" href="https://www.youtube.com/channel/UCAd74izRxuMkA5UsTEQ0xnA?view_as=subscriber" target="_blank"></a> </div>
          <div class="copy">
              <p>Copyright &copy; <?= date('Y'); ?> Peace For Recruitment</p>
          </div>
      </div>
  </div>



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
        //$.fn.select2.defaults.set("theme", "bootstrap");
//        $.fn.select2.defaults.set("width", null);
//        $('.select2-field').select2({
//            dir: "rtl",
//        });
//        $('.select2-field').parent().find('.select2-container').css('width', '');


    </script>

  </body>
</html>
