<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Style Settings</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                        </ul>

                        <div class="panel panel-default m-t">
                            <?php $this->load->view('includes/flash_messages'); ?>
                            <div class="panel-heading"><span class="glyphicon glyphicon glyphicon-wrench"></span> Style Settings</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <form action="" class="form-horizontal" id="" method="post">
                                        <!--                                   <div class="col-sm-12">-->
                                        <fieldset>

                                            <div class="form-group">
                                                <label for="contract_1_top_margin" class="control-label col-md-3">Customer Contract Top Margin: </label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'contract_1_top_margin',
                                                        'class'         => 'form-control',
                                                        'id'            => 'contract_1_top_margin',
                                                        'value'         => set_value('contract_1_top_margin', $style_settings->contract_1_top_margin),
                                                        'placeholder'   => 'Contract 1 Top Margin ex: 4cm',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?= form_error('contract_1_top_margin'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->

                                            <div class="form-group">
                                                <label for="contract_2_top_margin" class="control-label col-md-3">Worker Contract Top Margin: </label>
                                                <div class="col-md-8">
                                                    <?php
                                                    $data = [
                                                        'name'          => 'contract_2_top_margin',
                                                        'class'         => 'form-control',
                                                        'id'            => 'contract_2_top_margin',
                                                        'value'         => set_value('contract_2_top_margin', $style_settings->contract_2_top_margin),
                                                        'placeholder'   => 'Contract 2 Top Margin ex: 4',
                                                    ];
                                                    ?>
                                                    <?= form_input($data); ?>
                                                    <?= form_error('contract_2_top_margin'); ?>
                                                </div>
                                            </div><!-- ./ form-group -->













                                            <div class="box-footer">
                                                <div class="col-md-6 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
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