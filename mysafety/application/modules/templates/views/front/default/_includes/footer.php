

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?php if (isset($js_file)): ?>
<?php if (is_array($js_file)): ?>
<?php foreach ($js_file as $file): ?>
<script src="<?= $file; ?>"></script>
<?php endforeach; ?>
<?php else: ?>
<script src="<?= $js_file; ?>"></script>
<?php endif; ?>
<?php endif; ?>
<script src="<?= site_url('assets/js/custom.js?') . filemtime(FCPATH . '/assets/js/custom.js'); ?>"></script>


  <script>
      if (!sessionStorage.adModal) {
          setTimeout(function () {
              $('#admodal').find('.item').first().addClass('active');
              $('#admodal').modal({
                  // backdrop: 'static',
                  // keyboard: false
              });
          }, 3000);
          $('#adCarousel').carousel({
              interval: 4000,
              cycle: true
          });

          $("#buttonSuccess").click(function (e) {
              e.preventDefault();
              var url = $(this).attr("href");
              var win = window.open(url, '_blank');
              $('#admodal').modal('hide');
          });
          sessionStorage.adModal = 1;
      }
  </script>

</body>
</html>

