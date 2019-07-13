
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
</body>
</html>