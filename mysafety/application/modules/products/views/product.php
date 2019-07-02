<div class="row">
    <div class="col-md-12">

            <div class="box box-info">
                <div class="box-body">


                  <div><a href="" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#product-image">Add New Image For <?= transText($product->name, get_current_lang()) . ' Product'; ?></a></div><br>

                    <table id="product-images-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th><?= lang('image') ?></th>
                                <th><?= lang('created_at'); ?></th>
                                <th><?= lang('actions'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>


    </div>
</div>


<div class="modal fade" id="product-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form action="<?= site_url('products/product/' . $product->id); ?>" method="post" enctype="multipart/form-data" id="form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('add_product_image') ?></h4>
            </div>
            <div class="modal-body">
                
            
                <div class="form-group">
                    <label for="permission" class="control-label"><?= lang('permission_name') ?> <span class="error">*</span></label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

           

            <div class="progress progress-sm progress-info">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0"             aria-valuemax="100" style="width: 20%"></div>

              </div>
              <div id="progress-status"></div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
                <button id="submit" type="submit" class="btn btn-success btn-ok"><?= lang('confirm') ?></button>
            </div>
        </div>
    </div>
    </form>

</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('delete_conf') ?></h4>
            </div>
            <div class="modal-body">
                <p><?= lang('delete_conf_msg') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
                <a class="btn btn-danger btn-ok"><?= lang('delete') ?></a>
            </div>
        </div>
    </div>
</div>