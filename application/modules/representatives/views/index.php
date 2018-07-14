<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Representatives</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Representatives</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'representatives/add'; ?>">Add New Representative</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Representative</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($representatives && count($representatives)): ?>
                                        <table id="representatives_table" class="table table-bordered table-striped">
                                           <thead>
                                           <tr>
                                               <th>Name</th>
                                               <th>Action</th>
                                           </tr>
                                           <?php foreach ($representatives as $representative): ?>
                                               <tr>
                                                   <td><?= $representative->name; ?></td>
                                                   <td>
                                                       <a href="<?= site_url('representatives/add/' . $representative->id); ?>" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Edit">
                                                           <span class="glyphicon glyphicon-edit"></span>
                                                       </a>
                                                       <a href="<?= site_url('representatives/delete/' . $representative->id) ?>" class="btn btn-danger delete-btn" data-toggle="tooltip" title="" data-original-title="Delete">
                                                           <span class="glyphicon glyphicon-trash"></span>
                                                       </a>
                                                   </td>
                                               </tr>

                                            <?php endforeach; ?>
                                           </thead>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no representative Added Yet</h2>
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="representative_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Representative</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td width="30%">Representative Name</td>
                                    <td id="representative_name"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Representative Email</td>
                                    <td id="representative_email"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Representative Email</td>
                                    <td id="representative_country"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Representative Phone</td>
                                    <td id="representative_phone"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Representative Address</td>
                                    <td id="representative_address"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Representative Image</td>
                                    <td><img src="" alt="" id="representative_image" class="img-thumbnail"></td>
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