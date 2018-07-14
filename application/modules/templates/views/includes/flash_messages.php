<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?= $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<?php
	if (is_array($this->session->flashdata("error"))) {
		foreach ($this->session->flashdata('error') as $error) {
			echo $error;
		}
	} else {
		echo $this->session->flashdata('error');
    }
	?>
	
</div>
<?php endif; ?>