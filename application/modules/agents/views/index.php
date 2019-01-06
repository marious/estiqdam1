<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('agents'); ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#"><?= lang('agents') ?></a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'agents/add'; ?>"><?= lang('add_new_agent'); ?></a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <?= lang('agents'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($agents && count($agents)): ?>
                                        <table id="agents_table" class="table table-bordered table-striped">
                                           <thead>
                                           <tr>
                                               <th><?= lang('name'); ?></th>
                                               <th><?= lang('country'); ?></th>
                                               <th><?= lang('action'); ?></th>
                                           </tr>
                                           <tbody>
                                            <?php foreach ($agents as $agent): ?>
                                                <tr>
                                                    <td><?= $agent->username; ?></td>
                                                    <td><?= $agent->country_name_in_arabic; ?></td>
                                                    <td>
                                                        <a href="<?= site_url('agents/add/' . $agent->id) ?>" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="<?= lang('edit') ?>">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </a>

                                                        <a href="<?= site_url('agents/delete/' . $agent->id); ?>" class="btn btn-danger delete-btn" data-toggle="tooltip" title="<?= lang('delete'); ?>" data-original-title="<?= lang('delete') ?>">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                        <?php if ($agent->suspended == 1): ?>
                                                            <a href="<?= site_url("agents/activate/" . $agent->id) ?>" class="btn btn-success"><?= lang('activate'); ?></a>
                                                        <?php else: ?>
                                                        <a href="<?= site_url('agents/suspend/' . $agent->id); ?>" class="btn btn-warning"><?= lang('suspend'); ?></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                           </thead>
                                        </table>
                                    <?php else: ?>
                                        <h2><?= lang('no_agent_added'); ?></h2>
                                    <?php endif; ?>
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="agent_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Agent</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td width="30%">Agent Name</td>
                                    <td id="agent_name"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Agent Email</td>
                                    <td id="agent_email"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Agent Email</td>
                                    <td id="agent_country"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Agent Phone</td>
                                    <td id="agent_phone"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Agent Address</td>
                                    <td id="agent_address"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Agent Image</td>
                                    <td><img src="" alt="" id="agent_image" class="img-thumbnail"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->