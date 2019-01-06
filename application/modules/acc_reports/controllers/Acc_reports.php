<?php
class Acc_reports extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('acc_lang');
        $this->adminSecurity();
    }


    public function check_permission()
    {
        if ($_SESSION['permission_role'] == 'user')
        {
            return redirect('404');
        }
        return true;
    }


    public function accountsReport($action = '')
    {
        $this->load->module('acc_admin');
        $this->data['accounts'] = $this->acc_admin->Acc_admin_model->get_all_accounts();
        if ($action == 'asyn')
        {
            $this->load->view('accounts_report', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('accounts_report', $this->data);
        }
        else if ($action == 'view')
        {
            $account=$this->input->post('account',true);
            $from_date=$this->input->post('from-date',true);
            $to_date=$this->input->post('to-date',true);
            $trans_type=$this->input->post('trans_type',true);
            $reportData=$this->acc_admin->Report_model->getAccountStatement($account,$from_date,$to_date,$trans_type);
            if(empty($reportData)){
                echo "false";
            }else{
                $dr=0;
                $cr=0;
                $bal=0;
                foreach ($reportData as $report) {
                    $dr=$dr+$report->dr;
                    $cr=$cr+$report->cr;
                    $bal=$report->bal;
                    ?>
                    <tr>
                        </td><td><?php echo $report->note ?></td>
                        <td style="text-align: center;"><?php echo date('d-m-Y', strtotime($report->trans_date)); ?>
                        <td class="text-right"><?php echo ($report->cr != 0) ? 'SAR ' . number_format($report->cr, 2) : ''; ?></td>
                        <td class="text-right"><?php echo ($report->dr != 0) ? 'SAR '. number_format($report->dr, 2) : ''; ?></td>
                        <td class="text-right"><?php echo ($report->bal != 0) ? 'SAR ' . $report->bal : $report->bal; ?></td>
                    </tr>


                    <?php
                }
                //Summery value
                echo "<tr><td colspan='2'><b>الاجمالى</b></td>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$dr."</b></td>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$cr."</b></td>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$bal."</b></td></tr>";
            }
        }

//        $this->check_permission();
    }


    // Date Wise Income Report
    public function dateWiseIncomeReport($action = '')
    {
        $this->check_permission();

        if ($action == 'asyn')
        {
            $this->load->view('datewise_income_report', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('datewise_income_report', $this->data);
        }
        else if ($action == 'view')
        {
            $from_date = $this->input->post('from-date', true);
            $to_date = $this->input->post('to-date', true);

            $this->load->module('acc_admin');
            $report_data = $this->acc_admin->Report_model->getIncomeReport($from_date, $to_date);
            if (empty($report_data)) {
                echo 'false';
            }
            else
            {
                $sum = 0;
                $i = 1;
                foreach ($report_data as $report)
                {
                    $sum = $sum + $report->amount;
                    ?>
                <tr>
                    <td width="1%"><?php echo $i; ?></td>
                    <td style="text-align: center;"><?php echo $report->trans_date ?></td>
                    <td><?php echo $report->accounts_name ?></td>
                    <td><?php echo $report->ref ?></td>
                    <td><?php echo $report->payer ?></td>
                    <td class="text-right"><?php echo get_current_setting('currency_code')." ".$report->amount ?></td>
                    <td><?php echo $report->note ?></td></tr>
                    <?php
                    $i++;
                    }
                echo "<tr><td colspan='5'><b>إجمالى المبلغ</b></td>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$sum."</b></td>";
                echo "<td></td></tr>";
            }
        }
    }


    //Date Wise Expense Report
    public function datewiseExpenseReport($action = '')
    {

        if ($action == 'asyn')
        {
            $this->load->view('datewise_expense_report', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('datewise_expense_report', $this->data);
        }
        else if ($action == 'view')
        {
            $from_date=$this->input->post('from-date',true);
            $to_date=$this->input->post('to-date',true);

            $this->load->module('acc_admin');
            $report_data = $this->acc_admin->Report_model->getExpenseReport($from_date, $to_date);
            if (empty($report_data))
            {
                echo "false";
            }
            else
            {
                $sum = 0;
                $i = 1;
                foreach ($report_data as $report) {
                    $sum=$sum+$report->amount;
                    ?>
                    <tr>
                        <td width="1%"><?php echo $i; ?></td>
                        <td style="text-align: center;"><?php echo $report->trans_date ?></td><td><?php echo $report->accounts_name ?></td>
                        <td><?php echo $report->payee ?></td>
                        <td class="text-right"><?php echo get_current_setting('currency_code')." ".$report->amount ?></td>
                        <td><?php echo get_current_setting('currency_code')." ".$sum; ?></td>
                        <td><?php echo $report->note ?></td></tr>

    <?php $i++;
                }
                echo "<tr><td colspan='5'><b>الاجمالى</b></td>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$sum."</b></td>";
            }
        }
    }




    //Income Vs Expense Report

    public function incomeVsExpense($action = '')
    {
        $this->check_permission();

        if($action=='asyn'){
            $this->load->view('income_vs_expense_report', $this->data);
        }else if($action==''){
            $this->accountantTemplate('income_vs_expense_report', $this->data);
        }else if($action=='view'){
            $from_date=$this->input->post('from-date',true);
            $to_date=$this->input->post('to-date',true);

            $this->load->module('acc_admin');
            $income = $this->acc_admin->Report_model->getIncomeReport($from_date,$to_date);
            $expense = $this->acc_admin->Report_model->getExpenseReport($from_date,$to_date);

            $income_count=count($income);
            $expense_count=count($expense);

            ?>
            <div class="col-md-6 col-lg-6 col-sm-6 join-table-1">
                <table class="table table-bordered">
                    <thead>
                    <th>Income Date</th><th>Note</th><th class="text-right">Amount</th>
                    <tbody>

                    <?php
                    $income_total=0;
                    foreach ($income as $report) {
                    $income_total=$income_total+$report->amount;
                    ?>

                    <tr><td><?php echo $report->trans_date ?></td>
                        <td><?php echo $report->note ?></td>
                        <td class="text-right"><?php echo get_current_setting('currency_code')." ".$report->amount ?></td>

                        <?php
                        }
                        if($expense_count>$income_count){
                            $dif=$expense_count-$income_count;
                            for($i=0;$i<$dif; $i++){
                                echo "<tr><td colspan='3'>&nbsp;</td></tr>";
                            }
                        }
                        echo "<tr><td colspan='2'><b>Total Income</b></td><td class='text-right'><b>".get_current_setting('currency_code')." ".$income_total."</b></td></tr>";

                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-6 join-table-2">
                <table class="table table-bordered">
                    <thead>
                    <th>Expense Date</th><th>Note</th><th class="text-right">Amount</th>
                    <tbody>
                    <?php
                    $expense_total=0;
                    foreach ($expense as $report) {
                    $expense_total=$expense_total+$report->amount;
                    ?>

                    <tr><td><?php echo $report->trans_date ?></td>
                        <td><?php echo $report->note ?></td>
                        <td class="text-right"><?php echo get_current_setting('currency_code')." ".$report->amount ?></td>
                        <?php
                        }

                        if($income_count>$expense_count){
                            $dif=$income_count-$expense_count;
                            for($i=0;$i<$dif; $i++){
                                echo "<tr><td colspan='3'>&nbsp;</td></tr>";
                            }
                        }
                        echo "<tr><td colspan='2'><b>Total Expense</b></td><td class='text-right'><b>".get_current_setting('currency_code')." ".$expense_total."</b></td></tr>";
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    }


    public function reportByPayer($action='')
    {
        $this->check_permission();

        $data=array();
        $this->load->module('acc_admin');
        $this->data['payerList']=$this->acc_admin->Acc_admin_model->get_payer_and_payee_by_type('Payer');
        if($action=='asyn'){
            $this->load->view('report_by_payer', $this->data);
        }else if($action==''){
            $this->accountantTemplate('report_by_payer', $this->data);
        }else if($action=='view'){
            $from_date=$this->input->post('from-date',true);
            $to_date=$this->input->post('to-date',true);
            $payer=$this->input->post('payer',true);

            $reportData=$this->acc_admin->Report_model->getPayerReport($from_date,$to_date,$payer);
            if(empty($reportData)){
                echo "false";
            }else{
                $dr=0;
                $cr=0;
                foreach ($reportData as $report) {
                    $dr=$dr+$report->dr;
                    $cr=$cr+$report->cr;
                    ?>

                    <tr><td><?php echo $report->trans_date ?></td>
                        <td><?php echo $report->accounts_name ?></td>
                        <td><?php echo $report->category ?></td>
                        <td><?php echo $report->type ?></td>
                        <td><?php echo $report->note ?></td>
                        <td><?php echo $report->payer ?></td>
                        <td class="text-right"><?php echo get_current_setting('currency_code')." ".$report->dr ?></td>
                        <td class="text-right"><?php echo get_current_setting('currency_code')." ".$report->cr ?></td></tr>

                    <?php
                }
                echo "<tr><td colspan='6'><b>Total</b>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$dr."</b></td>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$cr."</b></td></tr>";
            }
        }
    }



    //Report By Payee
    public function reportByPayee($action='')
    {
        $this->check_permission();


        $data=array();
        $this->load->module('acc_admin');
        $this->data['payeeList']=$this->acc_admin->Acc_admin_model->get_payer_and_payee_by_type('Payee');
        if($action=='asyn'){
            $this->load->view('report_by_payee',$this->data);
        }else if($action==''){
            $this->accountantTemplate('report_by_payee', $this->data);
        }else if($action=='view'){
            $from_date=$this->input->post('from-date',true);
            $to_date=$this->input->post('to-date',true);
            $payee=$this->input->post('payee',true);

            $reportData=$this->acc_admin->Report_model->getPayeeReport($from_date,$to_date,$payee);
            if(empty($reportData)){
                echo "false";
            }else{
                $dr=0;
                $cr=0;
                foreach ($reportData as $report) {
                    $dr=$dr+$report->dr;
                    $cr=$cr+$report->cr;
                    ?>

                    <tr><td><?php echo $report->trans_date ?></td>
                        <td><?php echo $report->accounts_name ?></td>
                        <td><?php echo $report->category ?></td>
                        <td><?php echo $report->type ?></td>
                        <td><?php echo $report->payee ?></td>
                        <td class="text-right"><?php echo get_current_setting('currency_code')." ".$report->dr ?></td>

                    <?php
                }
                echo "<tr><td colspan='5'><b>".lang('total')."</b>";
                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$dr."</b></td>";
//                echo "<td class='text-right'><b>".get_current_setting('currency_code')." ".$cr."</b></td></tr>";
            }
        }
    }


    public function categoryReport()
    {
        $this->load->module('acc_admin');

        $date_from = filter_input(INPUT_GET, 'date-from');
        $date_to = filter_input(INPUT_GET, 'date-to');
        $category = filter_input(INPUT_GET, 'category');

        $expenses = $this->acc_admin->Report_model->getExpenseByCategory($date_from, $date_to, $category);
        $this->data['expenses'] = $expenses;
        $this->data['date_from'] = $date_from;
        $this->data['date_to'] = $date_to;
        $this->data['category'] = $category;

        $this->accountantTemplate('expense_category_report', $this->data);
    }


}