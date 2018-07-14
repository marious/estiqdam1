<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?= site_url('assets/css/bootstrap.min.css') ?>">
	<style>
		body {
			color: #374767;
			background-color: #f1f3f6;
		}
		.wrapper {
			position: relative;
			min-height: 100%;
		}
		.container-center {
			max-width: 400px;
			margin: 10% auto 0;
			padding: 20px;
		}
		.form-control {
			box-shadow: none;
			border: 1px solid #e4e5e7;
			border-radius: none !important;
		}
		.view-header {
			margin: 10px 0;
		}
		.panel-heading {
			border-color: #e4e5e7;
			color: #374767;
			background-color: #fff;
			position: relative;
		}
		.header-icon {
			font-size: 40px;
			color: #37a000;
			width: 40px;
			/*margin-top: -8px;*/
			line-height: 0;
			font-weight: 100;
			float: left;
		}
		.header-title {
			margin-left: 60px;
		}
		.panel-bd .panel-heading:before {
			content: '';
			width: 0;
			height: 0;
			border-top: 12px solid #37a000;
			border-right: 12px solid transparent;
			position: absolute;
			left: 0;
			top: 0;
		}
		.btn-success {
			background-color: #37a000;
			border-color: #318d01;
		}
		.btn-success:hover {
			background-color:#45c203;
			border-color:#318d01
		}
		.form-control:focus {
			border-color:#37a000;box-shadow:none
		}
		.input-group-addon {
			padding-top: 5px !important;
			padding-bottom: 5px !important;
		}
	</style>
</head>
<body>
	<!-- <div class="se-pre-con" style="display: none;"></div> -->
	<div class="wrapper">
		<div class="container-center">

			<?php if ($this->session->flashdata()): ?>
			<div class="alert alert-danger alert-dismissable">
			     <!--    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
			        <?php echo $this->session->flashdata('error_message'); ?>                  
			    </div>
			<?php endif; ?>

			<div class="panel panel-bd">
				<div class="panel-heading">
					<div class="view-header">
						<div class="header-icon">
							<span class="glyphicon glyphicon-log-in"></span>
						</div>
						<div class="header-title">
							<h3>Login</h3>
							<small><strong>Please enter your login information.</strong></small>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<form action="" method="post" class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-sm-3" for="username">Username</label>
                            <div class="col-sm-9">
                                <input type="text" title="username" required id="username" name="username" class="form-control">
                            </div>
						</div>
						<div class="form-group">
							<label for="password" class="control-label col-sm-3">Password</label>
							<div class="col-sm-9">
                                <input type="password" title="Please enter your password"
                                       required name="password" id="password" class="form-control">
                            </div>
						</div>

						<div>
							<?php // echo $cicaptcha_html; ?>
						</div>
						<br>
						<div>
							<button class="btn btn-success btn-block btn-lg">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>