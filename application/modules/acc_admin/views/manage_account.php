<!--Statt Main Content-->
<section>
    <div class="main-content">
        <div class="row">
            <div class="inner-contatier">
                <div class="col-md-12 col-lg-12 col-sm-12 content-title"><h4>Accounts</h4></div>
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <!--Start Panel-->
                    <div class="panel panel-default">
                        <!-- Default Panel Content -->
                        <div class="panel-heading">Manage Accounts <div class="add-button">
                                <a href="<?= site_url('acc_admin/addAccount') ?>" class="mybtn btn-default asyn-link">Add Account</a>
                            </div></div>
                        <div class="panel-body manage-client">
                            <table class="table table-bordered table-striped table-condensed">
                                <th>Account</th>
                                <th>Starting Balance</th>
                                <th>Current Balance</th>
                                <th>Note</th>
                                <th class="action">Action</th>
                                <?php
                                $this->load->module('acc_admin');
                                $financial_accounts = $this->acc_admin->Report_model->financialBalance();
                                ?>
                                <?php foreach ($financial_accounts as $account): ?>
                                <tr>
                                    <td><?= $account->account; ?></td>
                                    <td><?= $account->opening_balance; ?></td>
                                    <td>
<?php echo $account->balance; ?>
                                    </td>
                                    <td><?= $account->note; ?></td>
                                    <td>
                                        <a href="<?= site_url('acc_admin/editAccount/' . $account->accounts_id) ?>" class="mybtn btn-info btn-xs account-edit-btn">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a href="<?= site_url('acc_admin/addAccount/remove/' . $account->accounts_id) ?>" class="mybtn btn-xs btn-danger account-remove-btn">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div><!--End Inner container-->
            </div><!--End Row-->
        </div><!--End Main-content DIV-->
</section><!--End Main-content Section-->


<script>
    $(document).ready(function() {
       $('.account-remove-btn').on('click', function(e) {
           var main = $(this);
           swal({
               title: "Are You Sure You want To Delete?",
               text: "You Will not be able to recover this Account Data!",
               type: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false,
               showLoaderOnConfirm: true
           }, function() {
              var link = $(main).attr('href');
              $.ajax({
                  url: link,
                  beforeSend: function() {
                      $('.block-ui').css('display', 'block');
                  },
                  success: function() {
                      $(main).closest('tr').remove();
                      $(".system-alert-box").empty();
                      swal("Deleted!", "Remove Sucessfully", "success");
                      $(".block-ui").css('display','none');
                  },
              });
           });

           return false;
       }) ;


       $('.account-edit-btn').on('click', function(e) {
          var link = $(this).attr('href');
          $.ajax({
              method: "POST",
              url: link,
              beforeSend: function() {
                $('.block-ui').css('display', 'block');
              },
              success: function() {
                  history.pushState(null, null, link);
                  $('.asyn-div').load(link+'/asyn',function() {
                      $(".block-ui").css('display','none');
                  });
              }
          });

          return false;
       });

    });
</script>