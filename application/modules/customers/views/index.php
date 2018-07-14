<section>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Customers</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#">Customers</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url() . 'customers/add'; ?>">Add New Customer</a>
                            </li>

                        </ul>

                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Customer</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($customers && count($customers)): ?>
                                        <table id="customers_table" class="table table-bordered table-striped">
                                           <thead>
                                           <tr>
                                               <th>Customer Name</th>
                                               <th>Username</th>
                                               <th>Nationality</th>
                                               <th>Mobile</th>
                                               <th>Action</th>
                                           </tr>
                                           </thead>
                                        </table>
                                    <?php else: ?>
                                        <h2>There is no customer Added Yet</h2>
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="customer_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Customer</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td width="30%">Customer Name</td>
                                    <td id="customer_name"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Customer Email</td>
                                    <td id="customer_email"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Customer Email</td>
                                    <td id="customer_country"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Customer Phone</td>
                                    <td id="customer_phone"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Customer Address</td>
                                    <td id="customer_address"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Customer Image</td>
                                    <td><img src="" alt="" id="customer_image" class="img-thumbnail"></td>
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