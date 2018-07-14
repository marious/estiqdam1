<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('tax_amount'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><?= lang('institution_details'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <form action="" class="form-horizontal" method="post">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                                        <?php endif; ?>
                                        <!--                                   <div class="col-sm-12">-->
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="tax_amount" class="control-label col-md-3"><?= lang('tax_amount'); ?></label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name' => 'tax_amount',
                                                        'class' => 'form-control',
                                                        'id' => 'tax_amount',
                                                        'value' => set_value('tax_amount', $institution->tax_amount),
                                                        'placeholder' => 'Tax Amount'
                                                    ];
                                                    echo form_input($data);
                                                    echo form_error('tax_amount');
                                                    ?>
                                                </div>
                                            </div>


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