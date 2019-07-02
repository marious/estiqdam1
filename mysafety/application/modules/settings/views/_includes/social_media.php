<div class="cl-md-12">

<form class="form-horizontal" action="<?= site_url('settings/add') ?>" method="post">
				<div class="box box-info">
					<div class="box-body">						
						<p style="padding-bottom: 20px;"><?= lang('social_note'); ?></p>

						<div class="form-group">
							<label for="facebook" class="col-sm-2 control-label"><?= lang('facebook'); ?> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="facebook" name="facebook" value="<?= setting('facebook'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="twitter" class="col-sm-2 control-label"><?= lang('twitter'); ?> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="twitter" name="twitter" value="<?= setting('twitter'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="linkedin" class="col-sm-2 control-label"><?= lang('linkedin') ?> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="linkedin" name="linkedin" value="<?= setting('linkedin') ?>">
							</div>
						</div>
					
						<div class="form-group">
							<label for="youtube" class="col-sm-2 control-label"><?= lang('youtube') ?> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="youtube" name="youtube" value="<?= setting('youtube') ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="instagram" class="col-sm-2 control-label"><?= lang('instagram') ?> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="instagram" name="instagram" value="<?= setting('instagram') ?>">
							</div>
						</div>
					
					
						<div class="form-group">
							<label for="whatsapp" class="col-sm-2 control-label"><?= lang('whatsapp') ?> </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= setting('whatsapp') ?>">
							</div>
						</div>
					
					
					
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1"><?= lang('save'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</form>

</div>