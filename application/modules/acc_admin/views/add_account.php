<!--Statt Main Content-->
<section>
    <div class="main-content <?= get_content_main_area_class();  ?>">
        <div class="row">
            <div class="inner-contatier">
                <div class="col-md-12 col-lg-12 col-sm-12 content-title"><h4><?= lang('accounts'); ?></h4></div>

                <!--Alert-->
                <div class="system-alert-box">
                    <div class="alert alert-success ajax-notify"></div>
                </div>
                <!--End Alert-->


                <div class="col-md-8 col-lg-8 col-sm-8 account-div">
                    <!--Start Panel-->
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><?= lang('add_account'); ?></div>
                        <div class="panel-body add-client">
                            <?php if(!isset($edit_account)){ ?>
                                <form id="add-accounts">
                                    <input type="hidden" name="action" id="action" value="insert"/>
                                    <input type="hidden" name="chart_id" id="accounts_id" value=""/>
                                    <div class="form-group">
                                        <label for="acc_name"><?= lang('account_name') ?></label>
                                        <input type="text" class="form-control" name="accounts_name" id="acc_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="balance"><?= lang('account_balance'); ?></label>
                                        <input type="text" class="form-control" name="opening_balance" id="balance">
                                    </div>
                                    <div class="form-group">
                                        <label for="note"><?= lang('note'); ?></label>
                                        <input type="text" class="form-control" name="note" id="note">
                                    </div>

                                    <button type="submit"  class="mybtn btn-submit"><i class="fa fa-check"></i> <?= lang('save'); ?></button>
                                </form>
                            <?php }else{ ?>

                                <form id="add-accounts">
                                    <input type="hidden" name="action" id="action" value="update"/>
                                    <input type="hidden" name="accounts_id" id="accounts_id" value="<?php echo $edit_account->accounts_id ?>"/>
                                    <div class="form-group">
                                        <label for="acc_name">Account Name</label>
                                        <input type="text" class="form-control" name="accounts_name" value="<?php echo $edit_account->accounts_name ?>" id="accounts_name">
                                    </div>

                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        <input type="text" class="form-control" value="<?php echo $edit_account->note ?>" name="note" id="note">
                                    </div>

                                    <button type="submit"  class="mybtn btn-submit"><i class="fa fa-check"></i> Save</button>
                                </form>

                            <?php } ?>

                        </div>
                        <!--End Panel Body-->
                    </div>
                    <!--End Panel-->

                </div>


            </div><!--End Inner container-->
        </div><!--End Row-->
    </div><!--End Main-content DIV-->
</section><!--End Main-content Section-->

<script>
    $(document).ready(function() {
       if ($('.sidebar').width() == '0') {
           $('.main-content').css('padding-left', '0px');
       }

       $('#balance').keypress(function(event) {
           if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
               (event.which < 48 || event.which > 57)) { event.preventDefault();
           }
       });


       $('#add-accounts').on('submit', function() {
          $.ajax({
              method: 'POST',
              url: "<?php echo site_url('acc_admin/addAccount/insert'); ?>",
              data: $(this).serialize(),
              beforeSend: function() {
                  $('.block-ui').css('display', 'block');
              },
              success: function(data) {
                  if (data == "true") {
                      sucessAlert("Saved Successfully");
                      $('.block-ui').css('display', 'none');
                      if ($("#action").val() != 'update') {
                          $('#acc_name').val('');
                          $('#balance').val('');
                          $('#note').val('');
                      }
                  } else {
                      failedAlert2(data);
                      $('.block-ui').css('display', 'none');
                  }
              }
          });

          return false;
       });

    });
</script>