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

<?php require('_includes/footer.php'); ?>