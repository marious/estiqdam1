<form class="form-horizontal" action="<?= site_url('settings/add'); ?>" method="post">
							<div class="box box-info">
								<div class="box-body">

                  <!-- En Footer Copyright -->
									<div class="form-group">
										<label for="en_footer_copyright" class="col-sm-2 control-label"><?= lang('en_footer_copyright') ?></label>
										<div class="col-sm-9">
											<input class="form-control" id="en_footer_copyright" type="text" name="en_footer_copyright" value="<?= setting('en_footer_copyright') ?>">
										</div>
									</div>		

                    <!-- AR Footer Copyright -->
									<div class="form-group">
										<label for="ar_footer_copyright" class="col-sm-2 control-label"><?= lang('ar_footer_copyright') ?></label>
										<div class="col-sm-9">
											<input class="form-control" id="ar_footer_copyright" type="text" name="ar_footer_copyright" value="<?= setting('ar_footer_copyright') ?>">
										</div>
									</div>						



                  <!-- EN Contact Addres  -->
									<div class="form-group">
										<label for="en_contact_address" class="col-sm-2 control-label"><?= lang('en_contact_address') ?> </label>
										<div class="col-sm-6">
											<textarea class="form-control" name="en_contact_address" style="height:80px;" id="en_contact_address"><?= setting('en_contact_address'); ?>
                      </textarea>
										</div>
									</div>

                   <!-- AR Contact Addres  -->
									<div class="form-group">
										<label for="ar_contact_address" class="col-sm-2 control-label"><?= lang('ar_contact_address') ?> </label>
										<div class="col-sm-6">
											<textarea class="form-control" name="ar_contact_address" style="height:80px;" id="ar_contact_address"><?= setting('ar_contact_address'); ?>
                      </textarea>
										</div>
									</div>



                  <!-- Contact Email Address -->
									<div class="form-group">
										<label for="contact_email" class="col-sm-2 control-label"><?= lang('contact_email'); ?> </label>
										<div class="col-sm-6">
											<input type="text" id="contact_email" class="form-control" name="contact_email" value="<?= setting('contact_email'); ?>">
										</div>
									</div>


                  <!-- Contact Phone Number -->
									<div class="form-group">
										<label for="contact_phone" class="col-sm-2 control-label"><?= lang('contact_phone'); ?> </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="contact_phone" name="contact_phone" value="<?= setting('contact_phone'); ?>">
										</div>
									</div>


                  <!-- Contact Fax Number -->
									<div class="form-group">
										<label for="contact_fax" class="col-sm-2 control-label"><?= lang('contact_fax') ?></label>
										<div class="col-sm-6">
											<input type="text" id="contact_fax" class="form-control" name="contact_fax" value="<?= setting('contact_fax'); ?>">
										</div>
									</div>


                  <!-- Contact Map -->
									<div class="form-group">
										<label for="contact_map_iframe" class="col-sm-2 control-label"><?= lang('contact_map_iframe') ?> </label>
										<div class="col-sm-6">
											<textarea class="form-control" id="contact_map_iframe" name="contact_map_iframe" rows="5"><?= setting('contact_map_iframe') ?></textarea>
										</div>
									</div>


									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form3"><?= lang('save'); ?></button>
										</div>
									</div>

								</div>
							</div>
							</form>