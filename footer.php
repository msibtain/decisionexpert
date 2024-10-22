</div>
</div>
</div>
</div>
</div>
</div>
<div class="tail-footer clear">
<div class="main">
<div class="footer clear">
<div align="center" style="color:#fff;" >Copyright © <?php echo date('Y') ?> Dr Mohammed Tikrity, All Rights Reserved.</div>
</div>
</div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo GOOGLE_SITE_KEY ?>"></script>
  <script>
  grecaptcha.ready(function() {
      grecaptcha.execute('<?php echo GOOGLE_SITE_KEY ?>', {action: 'homepage'}).then(function(token) {
          if (jQuery('#gcaptcha-token').length)
          {
              jQuery('#gcaptcha-token').val(token);
          }
      });
  });
  </script>
</body></html>