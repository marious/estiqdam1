  
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

  <script type="text/javascript">
      var LHCChatOptions = {};
      LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500};
      (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
          var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
          po.src = '//localhost/mysafety/chat2/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true?r='+referrer+'&l='+location;
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
  </script>
<script src="<?= site_url('assets/js/custom.js'); ?>"></script>
</body>
</html>