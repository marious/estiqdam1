<!--Statt Main Content-->
<section>
    <div class="main-content <?= get_content_main_area_class();  ?>">
        <div class="row">
            <div class="inner-contatier">
                <div class="col-md-12 col-lg-12 col-sm-12 content-title"><h4>Tricky Report Viewer</h4></div>
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <!--Start Panel-->
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><?= lang('account_report'); ?></div>
                        <div class="panel-body">
                            <div class="col-md-12 col-lg-12 col-sm-12 report-params">
                                <form id="account-statement" action="<?php echo site_url('acc_reports/accountsReport/view') ?>">

                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                        <div class="form-group">
                                            <select class="form-control" name="account" id="account">
                                                <?php foreach($accounts as $account){ ?>
                                                    <option value="<?php echo $account->accounts_name ?>"><?php echo $account->accounts_name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                        <div class="form-group">
                                            <div class='input-group date' id='date'>
                                                <input type="text" class="form-control" placeholder="<?= lang('date_from'); ?>" name="from-date" id="from-date" autocomplete="off">
                                                <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                        <div class="form-group">
                                            <div class='input-group'>
                                                <input type="text" class="form-control" placeholder="<?= lang('date_to'); ?>" name="to-date" id="to-date" autocomplete="off">
                                                <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-lg-2 col-sm-2">
                                        <select class="form-control" name="trans_type" id="trans_type">
                                            <option value="dr"><?= lang('debit'); ?></option>
                                            <option value="cr"><?= lang('credit'); ?></option>
                                            <option value="All" selected><?= lang('all'); ?></option>
                                        </select>
                                    </div>

                                    <div class="col-md-1 col-lg-1 col-sm-1">
                                        <button type="submit"  class="mybtn btn-submit"><i class="fa fa-play"></i></button>
                                    </div>
                                </form>
                            </div>


                            <div class="Report-Toolbox col-md-6 col-lg-6 col-sm-6 col-md-offset-6 col-lg-offset-6 col-sm-offset-6">
                                <button type="button" class="btn btn-primary print-btn"><i class="fa fa-print"></i> <?= lang('print'); ?></button>
<!--                                <button type="button" class="btn btn-info pdf-btn"><i class="fa fa-file-pdf-o"></i> PDF Export</button>-->
                            </div>
                            <div id="Report-Table" class="col-md-12 col-lg-12 col-sm-12">
                                <div class="preloader"><img src="<?php echo base_url() ?>theme/images/ring.gif"></div>
                                <div class="report-heading">
                                    <h4><?= lang('account_report'); ?></h4>
                                    <p><?= lang('date_from'); ?> - - - - <?= lang('to'); ?> - - - -</p>
                                </div>
                                <div id="Table-div">
                                    <table class="table table-bordered report-table" style="width: 70%; margin: 0 auto;">
                                        <thead>
                                            <th width="18%">البيان</th>
                                            <th width="10%">التاريخ الميلادى</th>
                                            <th width="10%" class="text-right">داخل</th>
                                            <th width="10%" class="text-right">خارج</th>
                                            <th width="10%" class="text-right">الرصيد</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Panel Body-->
                    </div>


                    <!--End Panel-->
                </div>
            </div><!--End Inner container-->
        </div><!--End Row-->
    </div><!--End Main-content DIV-->
</section><!--End Main-content Section-->

<!--<script src="<?php echo base_url() ?>/theme/js/pdf/jspdf.debug.js"></script>-->

<script type="text/javascript">
    $(document).ready(function() {
        $("#from-date, #to-date").datepicker({rtl: true});
        $("#account").select2();


        $('#account-statement').on('submit',function(){
            var link=$(this).attr("action");
            if($("#from-date").val()!="" && $("#to-date").val()!=""){
//query data
                $.ajax({
                    method : "POST",
                    url : link,
                    data : $(this).serialize(),
                    beforeSend : function(){
                        $(".preloader").css("display","block");
                    },success : function(data){
                        $(".preloader").css("display","none");
                        if(data!="false"){
                            $("#Report-Table tbody").html(data);
                            $(".report-heading h4").html("كشف الحساب "+$("#account").val());
                            $(".report-heading p").html("<?= lang('date_from'); ?> "+$("#from-date").val()+" <?= lang('to'); ?> "+$("#to-date").val());
                        }else{
                            $("#Report-Table tbody").html("");
                            $(".report-heading h4").html("<?= lang('account_report'); ?> "+$("#account").val());
                            $(".report-heading p").html("<?= lang('date_from') ?> "+$("#from-date").val()+" <?= lang('to') ?> "+$("#to-date").val());
                            swal("Alert","Sorry, No Data Found !", "info");
                        }
                    }

                });
            }else{
                swal("Alert","Please Select Date Range.", "info");
            }

            return false;
        });


    });

    function Print(data)
    {
        var w = (screen.width);
        var h = (screen.height);
        var mywindow = window.open('', 'Print-Report', 'width='+w+',height='+h);
        mywindow.document.write('<!doctype html><html><head><meta charset="utf-8"><title>Print-Report</title>');
        mywindow.document.write('<link href="<?php echo base_url() ?>theme/css/bootstrap.css" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url() ?>theme/css/my-style.css?v=<?php echo filemtime(FCPATH . 'theme/css/my-style.css');  ?>" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url() ?>theme/css/print.css?v=<?php echo filemtime(FCPATH . 'theme/css/print.css');  ?>" rel="stylesheet">');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        // mywindow.document.close(); // necessary for IE >= 10
        // mywindow.focus(); // necessary for IE >= 10
        //
        // mywindow.print();
        // mywindow.close();

        return true;
    }


</script>

