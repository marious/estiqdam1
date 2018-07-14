<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= $title; ?></h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <?php if (isset($status) && $status == true): ?>

                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Workers</a>
                            </li>
                            <?php if ($agent->suspended != 1): ?>
                            <li class="">
                                <a href="<?= base_url() . 'agent_worker/add'; ?>">Add New</a>
                            </li>
                            <?php endif; ?>

                        </ul>
                        <?php endif; ?>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"></span> Agent Workers</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php $i = 1; ?>
                                    <?php if ($workers && count($workers)): ?>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Photo</th>
                                                    <th>Worker Name</th>
                                                    <th>Position Applied</th>
                                                    <th>Salary</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Passport Number</th>
                                                    <?php if (isset($status) && $status == true): ?>
                                                    <th>Status</th>
                                                    <?php endif; ?>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($workers as $worker): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><img src="<?= site_url('assets/img/workers/' . $worker->image) ?>" class="worker-img"></td>
                                                    <td><?= $worker->name ?></td>
                                                    <td><?= $worker->job; ?></td>
                                                    <td><?= $worker->salary; ?></td>
                                                    <td><?= $worker->date_of_birth; ?></td>
                                                    <td><?= $worker->passport_number; ?></td>
                                                    <?php if (isset($status) && $status == true): ?>
                                                    <td>
                                                        <?php
                                                        $this->load->module('agent_worker');
                                                        echo $this->agent_worker->Agent_worker_model->get_worker_status($worker->id);
                                                        ?>
                                                    </td>
                                                    <?php endif; ?>
                                                   <td>
                                                       <div class="btn-group">
                                                           <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                               <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                                                           </button>
                                                           <ul class="datatable-dropdown dropdown-menu icons-left" role="menu">
                                                               <li><a href="<?php echo site_url('agent_worker/view/' . $worker->id); ?>" class="" target="_blank">
                                                                       <i class="glyphicon glyphicon-eye-open"></i> View</a></li>
                                                               <li><a href="<?php echo site_url('agent_worker/add/' . $worker->id); ?>" class="">
                                                                       <i class="glyphicon glyphicon-edit"></i> Edit</a></li>

                                                           </ul>
                                                       </div>
                                                   </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                    <h3>): Sorry There is No Workers Found IN <?= $title; ?> Category</h3>
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