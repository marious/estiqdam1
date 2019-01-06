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
                        <div class="panel-heading"><?= lang('date_wise_expense_report'); ?></div>
                        <div class="panel-body">
                            <div class="Report-Toolbox col-md-6 col-lg-6 col-sm-6 col-md-offset-6 col-lg-offset-6 col-sm-offset-6">
                                <button type="button" class="btn btn-primary print-btn"><i class="fa fa-print"></i> <?= lang('print'); ?></button>
                                <!--                                <button type="button" class="btn btn-info pdf-btn"><i class="fa fa-file-pdf-o"></i> PDF Export</button>-->
                            </div>
                            <div id="Report-Table" class="col-md-12 col-lg-12 col-sm-12">
                                <div class="preloader"><img src="<?php echo base_url() ?>theme/images/ring.gif"></div>
                                <div class="report-heading">
                                    <h4><?= lang('date_wise_expense_report'); ?></h4>
                                    <p><?= lang('date_from') ?> <?= $date_from; ?> <?= lang('date_to'); ?> <?= $date_to; ?></p>
                                </div>
                                <div id="Table-div">
                                    <table class="table table-bordered report-table">
                                        <thead>
                                        <th width="1%">#</th>
                                        <th width="10%">التاريخ</th>
                                        <th width="10%">الحساب</th>
                                        <th width="10%">العملية</th>
                                        <th width="15%">المدفوع له</th>
                                        <th class="text-right" width="10%">المبلغ</th>
                                        <th width="25%">ملاحظة</th>
                                        <tbody>
                                            <?php $dr = 0; $i = 1; foreach($expenses as $expense): ?>
                                            <?php
                                                $dr=$dr+$expense->dr;
                                                ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?php echo $expense->trans_date ?></td>
                                                <td><?php echo $expense->accounts_name ?></td>
                                                <td><?php echo $expense->category ?></td>
                                                <td><?php echo $expense->payee ?></td>
                                                <td class="text-right"><?php echo get_current_setting('currency_code')." ".$expense->dr ?></td>
                                                <td><?= $expense->note; ?></td>
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                            <?php echo "<tr><td colspan='6'><b>".lang('total')."</b>"; ?>
                                            <?php echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$dr."</b></td>"; ?>

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


<script type="text/javascript">
    $(document).ready(function() {
        $("#from-date, #to-date").datepicker();


        $('#expense-report').on('submit',function(){
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
                            $(".report-heading p").html("<?= lang('date_from'); ?> "+$("#from-date").val()+" <?= lang('to'); ?> "+$("#to-date").val());
                        }else{
                            $("#Report-Table tbody").html("");
                            $(".report-heading p").html("<?= lang('date_from'); ?> "+$("#from-date").val()+" <?= lang('to'); ?> "+$("#to-date").val());
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
        mywindow.document.write('<html><head><title>Print-Report</title>');
        mywindow.document.write('<link href="<?php echo base_url() ?>theme/css/bootstrap.css" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url() ?>/theme/css/my-style.css?v=<?php echo filemtime(FCPATH . 'theme/css/my-style.css');  ?>" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url() ?>/theme/css/print.css?v=<?php echo filemtime(FCPATH . 'theme/css/print.css');  ?>" rel="stylesheet">');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        // mywindow.document.close(); // necessary for IE >= 10
        // mywindow.focus(); // necessary for IE >= 10

        // mywindow.print();
        // mywindow.close();


        return true;
    }


</script>

