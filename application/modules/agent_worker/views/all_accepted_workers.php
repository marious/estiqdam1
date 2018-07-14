<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3>All Accepted Workers</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?= lang('agent_workers'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <div class="">
                                        <table id="all-workers" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الصورة</th>
                                                <th>الاسم</th>
                                                <th>رقم الجواز</th>
                                                <th>المهنة</th>
                                                <th>الراتب</th>
                                                <th>
                                                    <select name="representative" id="agent" class="form-control">
                                                        <option value="">المكتب</option>
                                                        <?php
                                                        foreach ($agents as $agent) {
                                                            echo '<option value="'.$agent->id.'">'.$agent->username.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </th>
                                                <th>اختيرت من</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div><!-- ./table-responsive -->
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
