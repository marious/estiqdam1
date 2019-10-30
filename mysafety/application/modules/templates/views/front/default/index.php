<?php require('_includes/head.php'); ?>

<div calss="wrapper-content">

<div id="wrapper">
  <?php require('_includes/header.php'); ?>

</div>

<div class="clearfix"></div>


<?php
if (isset($view_file)) {
    $this->load->view($view_module . '/' . $view_file);
}
?>
</div>


<footer>
    <div class="container">
        <p>Copyright <?=date('Y')?> All Right Reserved</p>
    </div>
</footer>

<!-- offer modal -->
<?php if ($offer): ?>
<div class="modal fade" id="admodal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: url(<?= site_url($offer->image) ?>) no-repeat center center/cover; height: 500px;">
            <div class="modal-body" style="min-height: 100%;">
                <div class="readmore-btn"><a href="<?= site_url('offers/offer/' . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encryption->encrypt($offer->id))) ?>"><?= lang('read_more') ?></a></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end offer modal -->
<?php endif; ?>

<?php require('_includes/footer.php'); ?>


