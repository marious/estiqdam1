<section>
    <div class="container">
        <div class="row">
           <div class="content">
               <div class="page-header">
                   <h3 class="page-title"><?= lang('site_settings'); ?></h3>
               </div>
               <!-- page header -->
                   <div class="page-content-wrapper m-t">
                       <div class="block-content">
                           <ul class="nav nav-tabs">
                               <li class="active">
                                   <a href="<?= base_url() . 'site_settings'; ?>"><?= lang('institution_details'); ?></a>
                               </li>
                               <li class="">
                                   <a href="<?= base_url() . 'site_settings/site_logo'; ?>">Site Logo</a>
                               </li>
                               <li class="">
                                   <a href="<?= base_url() . 'site_settings/get_translation'; ?>">Translation</a>
                               </li>
                           </ul>

                           <div class="panel panel-default m-t">
                               <div class="panel-heading"><?= lang('institution_details'); ?></div>
                               <div class="panel-body">
                                   <div class="tab-content m-t">
                                       <form action="" class="form-horizontal" id="institution-details">
                                           <!--                                   <div class="col-sm-12">-->
                                           <fieldset>
                                               <div class="form-group">
                                                   <label for="name_in_english" class="control-label col-md-3"><?= lang('institution_english_name'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'name_in_english',
                                                           'class'         => 'form-control',
                                                           'id'            => 'name_in_english',
                                                           'value'         => set_value('name_in_english', $institution->name_in_english),
                                                           'placeholder'   => 'Name In English',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="name_in_arabic" class="control-label col-md-3"><?= lang('institution_arabic_name'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'name_in_arabic',
                                                           'class'         => 'form-control',
                                                           'id'            => 'name_in_arabic',
                                                           'value'         => set_value('name_in_arabic', $institution->name_in_arabic),
                                                           'placeholder'   => 'Name In Arabic',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="phone" class="control-label col-md-3"><?= lang('phone_number'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'phone',
                                                           'class'         => 'form-control',
                                                           'id'            => 'phone',
                                                           'value'         => set_value('phone', $institution->phone),
                                                           'placeholder'   => 'Phone Number',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="mobile" class="control-label col-md-3"><?= lang('mobile_number'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'mobile',
                                                           'class'         => 'form-control',
                                                           'id'            => 'mobile',
                                                           'value'         => set_value('mobile', $institution->mobile),
                                                           'placeholder'   => 'Mobile Number',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="fax" class="control-label col-md-3"><?= lang('fax'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'fax',
                                                           'class'         => 'form-control',
                                                           'id'            => 'fax',
                                                           'value'         => set_value('fax', $institution->fax),
                                                           'placeholder'   => 'Fax',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="email" class="control-label col-md-3"><?= lang('email_address'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'email',
                                                           'class'         => 'form-control',
                                                           'id'            => 'email',
                                                           'value'         => set_value('email', $institution->email),
                                                           'placeholder'   => 'Email Address',
                                                           'type'           => 'email',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="address_in_english" class="control-label col-md-3"><?= lang('address_in_english'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'address_in_english',
                                                           'class'         => 'form-control',
                                                           'id'            => 'address_in_english',
                                                           'value'         => set_value('address_in_english', $institution->address_in_english),
                                                           'placeholder'   => 'Address In English',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="address_in_arabic" class="control-label col-md-3"><?= lang('address_in_arabic'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'address_in_arabic',
                                                           'class'         => 'form-control',
                                                           'id'            => 'address_in_arabic',
                                                           'value'         => set_value('address_in_arabic', $institution->address_in_arabic),
                                                           'placeholder'   => 'Address In Arabic',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->


                                               <div class="form-group">
                                                   <label for="licence_number" class="control-label col-md-3"><?= lang('licence_number'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'licence_number',
                                                           'class'         => 'form-control',
                                                           'id'            => 'licence_number',
                                                           'value'         => set_value('licence_number', $institution->licence_number),
                                                           'placeholder'   => 'Licence Number',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="commercial_licence" class="control-label col-md-3"><?= lang('commercial_licence'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'commercial_licence',
                                                           'class'         => 'form-control',
                                                           'id'            => 'commercial_licence',
                                                           'value'         => set_value('commercial_licence', $institution->commercial_licence),
                                                           'placeholder'   => 'Commercial Licence',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->

                                               <div class="form-group">
                                                   <label for="website" class="control-label col-md-3"><?= lang('website'); ?></label>
                                                   <div class="col-md-8">
                                                       <?php
                                                       $data = [
                                                           'name'          => 'website',
                                                           'class'         => 'form-control',
                                                           'id'            => 'website',
                                                           'value'         => set_value('website', $institution->website),
                                                           'placeholder'   => 'Website',
                                                       ];
                                                       ?>
                                                       <?= form_input($data); ?>
                                                   </div>
                                               </div><!-- ./ form-group -->



                                            <div class="box-footer">
                                                <div class="col-md-6 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary btn-block"><?= lang('save'); ?></button>
                                                </div>
                                            </div>


                                           </fieldset>
                                           <!--                                   </div>-->
                                       </form>
                                   </div>
                               </div>
                           </div>

                       </div>
                   </div>
               <!-- ./page-header -->
           </div>
        </div>
    </div>
</section>