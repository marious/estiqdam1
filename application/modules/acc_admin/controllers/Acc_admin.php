<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Acc_admin_model');
        $this->load->model('Report_model');
        $this->load->library('form_validation');
        $this->adminSecurity();
    }



    public function index()
    {
        $this->data['cart_summery']=$this->Report_model->getIncomeExpense();
        $this->data['line_chart']=$this->Report_model->dayByDayIncomeExpense();
//        var_dump($this->data['line_chart']);exit;
        $this->data['latest_income']=$this->Acc_admin_model->get_transaction(5,'Income');
        $this->data['latest_expense']=$this->Acc_admin_model->get_transaction(5,'Expense');
        $this->data['pie_data']=$this->Report_model->sumOfIncomeExpense();
        $this->data['financialBalance']=$this->Report_model->financialBalance();
        $this->accountantTemplate('index', $this->data);
    }



    /** Method For dashboard **/
    public function dashboard($action='')
    {
        $this->data['cart_summery']=$this->Report_model->getIncomeExpense();
        $this->data['line_chart']=$this->Report_model->dayByDayIncomeExpense();
        $this->data['latest_income']=$this->Acc_admin_model->get_transaction(5,'Income');
        $this->data['latest_expense']=$this->Acc_admin_model->get_transaction(5,'Expense');
        $this->data['pie_data']=$this->Report_model->sumOfIncomeExpense();
        $this->data['financialBalance']=$this->Report_model->financialBalance();
        if($action=='asyn'){
            $this->load->view('index',$this->data);
        }else if($action==''){
            $this->accountantTemplate('index', $this->data);
        }
    }

   /* Method for Add New Account And Account Page View */
   public function addAccount($action = '', $param1 = '')
   {
       $this->check_permission();


       if ($action == 'asyn')
       {
            $this->load->view('add_account', $this->data);
       }
       else if ($action == '')
       {
            $this->accountantTemplate('add_account', $this->data);
       }
       //--------------------- End Page View -----------------------//
       if ($action == 'insert')
       {
           $data = array();
           $do = $this->input->post('action', true);
           $data['accounts_name'] = $this->input->post('accounts_name', true);
           $data['note'] = $this->input->post('note', true);
           $data['user_id'] = $_SESSION['id'];
           //--------------------------- VALIDATION -------------------------------//
           $this->form_validation->set_rules('accounts_name', 'Account Name', 'trim|required|max_length[30]');
           $this->form_validation->set_rules('note', 'Note', 'trim|required');

           if (! $this->form_validation->run() == false)
           {
               if ($do == 'insert')
               {
                   // Check Duplicate Entry
                   if (! value_exists('accounts', 'accounts_name', $data['accounts_name']))
                   {
                       $data['opening_balance'] = $this->input->post('opening_balance', true);

                       $this->db->trans_begin();
                       $this->db->insert('accounts', $data);
                       // Insert Transaction data
                       $this->insertTransaction($data['accounts_name'], $data['opening_balance']);
                       $this->db->trans_complete();
                       if ($this->db->trans_status() === false)
                       {
                           $this->db->trans_rollback();
                       }
                       else
                       {
                           echo 'true';
                           $this->db->trans_commit();
                       }
                   }
                   else
                   {
                       echo "This Account Is Already Exists!";
                   }
               }
               else if ($do == 'update')
               {
                    $id = $this->input->post('accounts_id', true);
                    if (!value_exists('accounts', 'accounts_name', $data['accounts_name'], "accounts_id", $id))
                    {
                        $old_name = getOld('accounts_id', $id, 'accounts');

                        $this->db->where('accounts_id', $id);
                        $this->db->update('accounts', $data);

                        // Transaction Table
                        $data1 = array();
                        $data1['accounts_name'] = $data['accounts_name'];
                        $this->db->where('accounts_name', $old_name->accounts_name);
                        $this->db->where('user_id', $_SESSION['id']);
                        $this->db->update('transaction', $data1);

                        // Repeat transaction table
                        $data2 = array();
                        $data2['account'] = $data['accounts_name'];
                        $this->db->where('account', $old_name->accounts_name);
                        $this->db->where('user_id', $_SESSION['id']);
                        $this->db->update('repeat_transaction', $data2);

                        echo "true";
                    }
                    else
                    {
                        echo 'This Account Is already Exists!';
                    }
               } // End Update
               else
               {
                   //echo "All Field Must Required With Valid Length !";
                   echo validation_errors('<span class="ion-android-alert failedAlert2"> ','</span>');
               }
           }    // End validation

       }
       else if ($action == 'remove')
       {
           $this->db->delete('accounts', array('accounts_id' => $param1));
       }

   }

    /** Method For insert Transaction when new account create **/
    public function insertTransaction($account, $amount)
    {
        $this->check_permission();


        $data = array();
        $data['accounts_name'] = $account;
        $data['trans_date'] = date('Y-m-d');
        $data['type'] = 'Transfer';
        $data['category'] = '';
        $data['amount'] = $amount;
        $data['payer']  = 'System';
        $data['payee'] = '';
        $data['p_method'] = '';
        $data['ref'] = '';
        $data['note'] = 'Opening Balance';
        $data['dr'] = 0;
        $data['cr'] = $amount;
        $data['bal'] = $amount;
        $data['user_id'] = $_SESSION['id'];
        $this->db->insert('transaction', $data);
    }


    /** Method For view Manage Account Page **/
    public function manageAccount($action = '')
    {
        $this->check_permission();


        $this->data['accounts'] = $this->Acc_admin_model->get_all_accounts();
        if ($action == 'asyn')
        {
            $this->load->view('manage_account', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('manage_account', $this->data);
        }
    }


    /** Method For get account information for Account Edit **/
    public function editAccount($accounts_id, $action = '')
    {
        $this->check_permission();


        $this->data['edit_account'] = $this->Acc_admin_model->get_by(array('accounts_id' => $accounts_id), true);
        if ($action == 'asyn')
        {
            $this->load->view('add_account', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('add_account', $this->data);
        }
    }


    /** Method For Income Page And Create New Income **/
    public function addIncome($action = '', $param1 = '')
    {
        $this->check_permission();


        $this->data['accounts'] = $this->Acc_admin_model->get_all_accounts();
        $this->data['category'] = $this->Acc_admin_model->get_chart_of_account_type('Income');
        $this->data['payers'] = $this->Acc_admin_model->get_payer_and_payee_by_type('Payer');
        $this->data['p_method'] = $this->Acc_admin_model->get_all_payment_method();
        $this->data['t_data'] = $this->Acc_admin_model->get_transaction(20, 'Income');

        if ($action == 'asyn')
        {
            $this->load->view('add_income', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('add_income', $this->data);
        }
        //----End Page Load------//
        //----For Insert update and delete-----//
        if ($action == 'insert')
        {
            $data = [];
            $do = $this->input->post('action', true);
            $data['accounts_name'] = $this->input->post('account', true);
            $data['trans_date'] = $this->input->post('income-date', true);
            $data['type'] = 'Income';
            $data['category'] = $this->input->post('income-type', true);
            $data['amount'] = $this->input->post('amount', true);
            $data['payer'] = $this->input->post('payer', true);
            $data['payee'] = '';
            $data['p_method'] = $this->input->post('p-method', true);
            $data['ref'] = $this->input->post('reference', true);
            $data['note']=$this->input->post('note',true);
            $data['dr']=0;
            $data['cr']=$this->input->post('amount',true);
            $data['user_id'] = $_SESSION['id'];

            //-----Validation-----//
            $this->form_validation->set_rules('account', 'Account Name', 'trim|required');
            $this->form_validation->set_rules('income-date', 'Date', 'trim|required');
            $this->form_validation->set_rules('income-type', 'Income Type', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            $this->form_validation->set_rules('payer', 'Payer', 'trim|required');
            $this->form_validation->set_rules('p-method', 'Payment Method', 'trim|required');
            $this->form_validation->set_rules('reference', 'Reference No', 'trim|required');
            $this->form_validation->set_rules('note', 'Note', 'trim|required|min_length[5]');


            if ($this->form_validation->run() == true)
            {
                if ($do == 'insert')
                {
                    $data['bal'] = $this->Acc_admin_model->get_balance($data['accounts_name'], $data['amount'], 'add');
                    if ($this->db->insert('transaction', $data))
                    {
                        echo "true";
                    }
                }
                else if ($do == 'update')
                {
                    $id=$this->input->post('trans_id',true);
                    $this->db->where('trans_id', $id);
                    $this->db->update('transaction', $data);
                    echo "true";
                }
            }
            else
            {
                echo validation_errors('<span class="ion-android-alert failedAlert2"> ','</span>');
            }
        }
        else if ($action == 'remove')
        {
            $this->db->delete('transaction', array('trans_id' => $param1));
        }
    }



    /** Method For Expense Page And Create New Expense **/
    public function addExpense($action = '', $param1 = '')
    {
        $this->data['accounts'] = $this->Acc_admin_model->get_all_accounts();
        $this->data['category'] = $this->Acc_admin_model->get_chart_of_account_by_type('Expense');
        $this->data['payee'] = $this->Acc_admin_model->get_payer_and_payee_by_type('Payee');
        $this->data['p_method'] = $this->Acc_admin_model->get_all_payment_method();
        $this->data['t_data'] = $this->Acc_admin_model->get_transaction(20, 'Expense');

        if ($action == 'asyn')
        {
            $this->load->view('add_expense', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('add_expense', $this->data);
        }
        //----End Page Load------//
        //----For Insert update and delete-----//
        if ($action == 'insert')
        {
            $data = [];
            $do = $this->input->post('action', true);
            $data['accounts_name'] = $this->input->post('account', true);
            $data['trans_date']=$this->input->post('expense-date',true);
            $data['type']='Expense';
            $data['category']=$this->input->post('expense-type',true);
            $data['amount']=$this->input->post('amount',true);
            $data['payer']='';
            $data['payee']=$this->input->post('payee',true);
            $data['p_method']=$this->input->post('p-method',true);
            $data['ref']=$this->input->post('reference',true);
            $data['note']=$this->input->post('note',true);
            $data['dr']=$this->input->post('amount',true);
            $data['cr']=0;
            $data['user_id']=$_SESSION['id'];

            //-----Validation-----//
            $this->form_validation->set_rules('account', 'Account Name', 'trim|required');
            $this->form_validation->set_rules('expense-date', 'Date', 'trim|required');
            $this->form_validation->set_rules('expense-type', 'Expense Type', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            $this->form_validation->set_rules('payee', 'Payee', 'trim|required');
            $this->form_validation->set_rules('p-method', 'Payment Method', 'trim|required');
            $this->form_validation->set_rules('reference', 'Reference No', 'trim|required');
            $this->form_validation->set_rules('note', 'Note', 'trim|required|min_length[5]');

            if ($this->form_validation->run() == true)
            {
                $data['bal'] = $this->Acc_admin_model->get_balance($data['accounts_name'],$data['amount'],"sub");
                if ($do == 'insert')
                {
                    if($this->db->insert('transaction',$data)){
                        echo "true";
                    }
                }
                else if ($do == 'update')
                {
                    $id=$this->input->post('trans_id',true);
                    $this->db->where('trans_id', $id);
                    $this->db->update('transaction', $data);
                    echo "true";
                }
            }
            else
            {
                echo validation_errors('<span class="ion-android-alert failedAlert2"> ','</span>');
            }

        }
        else if ($action == 'remove')
        {
            $this->db->delete('transaction', array('trans_id' => $param1));
        }
    }


    /** Method For Transfer Page and create new transfer **/

    /** Method For Transfer Page and create new transfer **/
    public function transfer($action='',$param1='')
    {
        $this->check_permission();


//        $data=array();
        $this->data['accounts']=$this->Acc_admin_model->get_all_accounts();
        $this->data['p_method']=$this->Acc_admin_model->get_all_payment_method();

        if($action=='asyn'){
            $this->load->view('add_transfer', $this->data);
        }else if($action==''){
            $this->accountantTemplate('add_transfer', $this->data);
        }

        //----End Page Load------//
        //----For Insert update and delete-----//
        if($action=='insert'){
            $data=array();
            $do=$this->input->post('action',true);
            $to_account=$this->input->post('to-account',true);
            $data['accounts_name']=$this->input->post('from-account',true);
            $data['trans_date']=$this->input->post('transfer-date',true);
            $data['type']='Transfer';
            $data['category']='';
            $data['amount']=$this->input->post('amount',true);
            $data['payer']='';
            $data['payee']='';
            $data['p_method']=$this->input->post('p-method',true);
            $data['ref']=$this->input->post('reference',true);
            $data['note']=$this->input->post('note',true);
            $data['dr']=$this->input->post('amount',true);
            $data['cr']=0;
            $data['bal']=$this->Acc_admin_model->get_balance($data['accounts_name'],$data['amount'],"sub");
            $data['user_id']= $_SESSION['id'];

            //-----Validation-----//
            $this->form_validation->set_rules('from-account', 'From Account', 'trim|required');
            $this->form_validation->set_rules('to-account', 'To Account', 'trim|required');
            $this->form_validation->set_rules('transfer-date', 'Date', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            $this->form_validation->set_rules('p-method', 'Payment Method', 'trim|required');
            $this->form_validation->set_rules('reference', 'Reference No', 'trim|required');
            $this->form_validation->set_rules('note', 'Note', 'trim|required|min_length[5]');

            if (!$this->form_validation->run() == FALSE)
            {
                if($do=='insert'){
                    if($data['accounts_name']!= $to_account){
                        $this->db->trans_begin();
                        $this->db->insert('transaction',$data);
                        $data['accounts_name']=$to_account;
                        $data['dr']=0;
                        $data['cr']=$this->input->post('amount',true);
                        $data['bal']=$this->Acc_admin_model->get_balance($data['accounts_name'],$data['amount'],"add");
                        $this->db->insert('transaction',$data);

                        if ($this->db->trans_status() === FALSE)
                        {
                            $this->db->trans_rollback();
                        }else{
                            echo "true";
                            $this->db->trans_commit();
                        }
                    }else{
                        echo "Sorry, Cannot Transfer Between Same Account !";
                    }

                }else if($do=='update'){
                    $id=$this->input->post('trans_id',true);
                    $this->db->where('trans_id', $id);
                    $this->db->update('transaction', $data);
                    echo "true";

                }
            }else{
                //echo "All Field Must Required With Valid Length !";
                echo validation_errors('<span class="ion-android-alert failedAlert2"> ','</span>');
            }
            //----End validation----//
        }
        else if($action=='remove'){
            $this->db->delete('transaction', array('trans_id' => $param1));
        }

    }






    /** Method For View,insert, update and delete Chart of accounts  **/
    public function chartOfAccounts($action = '', $param1 = '')
    {
        $this->check_permission();


        $this->data['accountList'] = $this->Acc_admin_model->get_all_chart_of_accounts();
        //----For ajax load-----//

        if ($action == 'asyn')
        {
            $this->load->view('chart_of_accounts', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('chart_of_accounts', $this->data);
        }
        //----End Page Load------//

        //----For Insert update and delete-----//
        if ($action == 'insert')
        {
            $do = $this->input->post('action', true);
            $this->data['accounts_name'] = $this->input->post('account', true);
            $this->data['accounts_type'] = $this->input->post('account-type', true);
            $this->data['user_id'] = $_SESSION['id'];
            $data = [];
            $data['accounts_name'] = $this->data['accounts_name'];
            $data['accounts_type'] = $this->data['accounts_type'];
            $data['user_id'] = $this->data['user_id'];
            //------------------- VALIDATION -------------------------
            if ( $this->data['accounts_name'] != '' && $this->data['accounts_type'] != '' && strlen($this->data['accounts_name']) <= 30
                    && strlen($this->data['accounts_type']) <= 7)
            {
                if ($do == 'insert')
                {
                    //Check Duplicate Entry
                    if(!value_exists2("chart_of_accounts","accounts_name",$data['accounts_name'],"accounts_type",$data['accounts_type']))
                    {
                        if ($this->db->insert('chart_of_accounts', $data))
                        {
                            $last_id = $this->db->insert_id();
                            echo '{"result":"true", "action":"insert", "last_id":"'.$last_id.'"}';
                        }
                    }
                    else
                    {
                        echo '{"result":"false", "message":"This Name Is Already Exists !"}';
                    }

                }
                else if ($do == 'update')
                {
                    $id = $this->input->post('chart_id', true);
                    // Check Duplicate Entry
                    if(!value_exists2("chart_of_accounts","accounts_name",$data['accounts_name'],"accounts_type",$data['accounts_type'],"chart_id",$id))
                        {
                        $this->db->where('chart_id', $id);
                        $this->db->update('chart_of_accounts', $data);
                        echo '{"result":"true","action":"update"}';
                    }
                    else
                    {
                        echo '{"result":"false", "message":"This Name Is Already Exists !"}';
                    }
                }
            }
            else
            {
                echo '{"result":"false", "message":"All Field Must Required With Valid Length !"}';
            }
            // END VAlIDATION
        }
        else if ($action == 'remove')
        {
            $this->db->delete('chart_of_accounts', array('chart_id' => $param1));
        }
    }




    /** Method For View,insert, update and delete payee And Payers  **/
    public function payeeAndPayers($action = '', $param1 = '')
    {

        $this->check_permission();


        $data = [];
        $this->data['p_list'] = $this->Acc_admin_model->get_all_payer_and_payee();
        //----For ajax load-----//
        if ($action == 'asyn')
        {
            $this->load->view('payee_payers', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('payee_payers', $this->data);
        }
        //----End Page Load------//
        //----For Insert update and delete-----//
        if ($action == 'insert')
        {
            $do = $this->input->post('action', true);
            $this->data['payee_payers'] = $this->input->post('p-name', true);
            $this->data['type'] = $this->input->post('p-type', true);
            $this->data['user_id'] = $_SESSION['id'];
            $data = [];
            $data['payee_payers'] = $this->data['payee_payers'];
            $data['type'] = $this->data['type'];
            $data['user_id'] = $this->data['user_id'];
            //-----Validation-----//
            if($this->data['payee_payers']!="" && $this->data['type']!="" &&
                strlen($this->data['payee_payers'])<=30 && strlen($this->data['type'])<=5)
            {
                if ($do == 'insert')
                {
                    //Check Duplicate Entry
                    if(!value_exists2("payee_payers","payee_payers",$this->data['payee_payers'],"type",$this->data['type'])){
                        if($this->db->insert('payee_payers',$data))
                        {
                            $last_id=$this->db->insert_id();
                            echo '{"result":"true", "action":"insert", "last_id":"'.$last_id.'"}';
                        }
                    }
                    else
                    {
                        echo '{"result":"false", "message":"This Name Is Already Exists !"}';;
                    }
                }
                else if ($do == 'update')
                {
                    $id=$this->input->post('trace_id',true);
                    if(!value_exists2("payee_payers","payee_payers",$this->data['payee_payers'],"type",$this->data['type'],"trace_id",$id))
                    {
                        $this->db->where('trace_id', $id);
                        $this->db->update('payee_payers', $data);
                        echo '{"result":"true", "action":"update"}';
                    }
                    else
                    {
                        echo '{"result":"false", "message":"This Name Is Already Exists !"}';;
                    }
                }
            }
            else
            {
                echo '{"result":"false", "message":"All Field Must Required With Valid Length !"}';
            }
            //----End validation----//
        }
        else if ($action == 'remove')
        {
            $this->db->delete('payee_payers', array('trace_id' => $param1));
        }
    }




    /** Method For View,insert, update and delete payment method  **/
    public function paymentMethod($action = '', $param1 = '')
    {
        $this->check_permission();


        $this->data['p_list'] = $this->Acc_admin_model->get_all_payment_method();
        //----For ajax load-----//
        if ($action == 'asyn')
        {
            $this->load->view('payment_method', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('payment_method', $this->data);
        }
        //----End Page Load------//
        //----For Insert update and delete-----//
        if ($action == 'insert')
        {
            $do = $this->input->post('action', true);
            $this->data['p_method_name'] = $this->input->post('p-method', true);
            $this->data['user_id'] = $_SESSION['id'];
            $data = [];
            $data['p_method_name'] = $this->data['p_method_name'];
            $data['user_id'] = $this->data['user_id'];
            //-----Validation-----//
            if ($data['p_method_name'] != '' && strlen($data['p_method_name']) <= 20)
            {
                if ($do == 'insert')
                {
                    //Check Duplicate Entry
                    if(!value_exists("payment_method","p_method_name",$data['p_method_name']))
                    {
                        if ($this->db->insert('payment_method', $data))
                        {
                            $last_id=$this->db->insert_id();
                            echo '{"result":"true", "action":"insert", "last_id":"'.$last_id.'"}';
                        }
                    }
                    else
                    {
                        echo '{"result":"false", "message":"This Payment Method Is Already Exists !"}';
                    }
                }
                else if ($do == 'update')
                {
                    $id = $this->input->post('p_method_id',true);
                    //Check Duplicate Entry
                    if(!value_exists("payment_method","p_method_name",$data['p_method_name'],"p_method_id",$id))
                    {
                        $this->db->where('p_method_id', $id);
                        $this->db->update('payment_method', $data);
                        $last_id=$this->db->insert_id();
                        echo '{"result":"true", "action":"update"}';
                    }
                    else
                    {
                        echo '{"result":"false", "message":"This Payment Method Is Already Exists !"}';
                    }
                }
            }
            else
            {
                echo '{"result":"false", "message":"All Field Must Required With Valid Length !"}';
            }
        }
        else if ($action == 'remove')
        {
            $this->db->delete('payment_method', ['p_method_id' => $param1]);
            echo '{"result":"true", action:"remove"}';
        }
    }



    /** Method For view manage Income page **/
    public function manageIncome($action = '')
    {
        $this->check_permission();


        $this->data['income_list'] = $this->Acc_admin_model->get_transaction('all', 'Income');
        if ($action == 'asyn')
        {
            $this->load->view('manage_income', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('manage_income', $this->data);
        }
    }


    /** Method For get data for edit transaction **/
    public function manageExpense($action = '')
    {
        $this->data['expense_list'] = $this->Acc_admin_model->get_transaction('all', 'Expense');
        if ($action == 'asyn')
        {
            $this->load->view('manage_expense', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('manage_expense', $this->data);
        }
    }



    /** Method For get data for edit transaction **/
    public function editTransaction($trans_id, $action = '')
    {
        $this->check_permission();


        $this->data['transaction'] = $this->Acc_admin_model->get_single_transaction($trans_id);
        $this->data['p_method'] = $this->Acc_admin_model->get_all_payment_method();
        if ($action == 'asyn')
        {
            $this->load->view('edit_transaction', $this->data);
        }
        else if ($action == '')
        {
            $this->accountantTemplate('edit_transaction', $this->data);
        }
    }


    /** Method For Update Transaction **/
    public function updateTransaction()
    {
        $this->check_permission();


        $data = [];
        $id = $this->input->post('trans_id', true);
        $data['trans_date'] = $this->input->post('date', true);
        $data['p_method'] = $this->input->post('p-method', true);
        $data['ref'] = $this->input->post('reference', true);
        $data['note'] = $this->input->post('note', true);

        $this->db->where('trans_id', $id);
        $this->db->update('transaction', $data);
        echo "true";
    }




    public function scan_payment_customer()
    {
        $this->check_permission();


        $query = "
            SELECT services_worker.worker_name_in_english, services_customer.customer_name_in_arabic,
            services_customer.customer_mobile, services_finance.prepaid_money, services_finance.remains_money, services_contract.representative_id,
            worker_nationality.nationality_in_arabic, representatives.name, contract.contract_number, contract.contract_date, staff.username
            FROM services_worker
            INNER JOIN services_customer
            ON services_customer.contract_number = services_worker.contract_number
            INNER JOIN services_finance 
            ON services_finance.contract_number = services_worker.contract_number
            INNER JOIN contract 
            ON contract.contract_number = services_worker.contract_number
            INNER JOIN services_order 
            ON services_order.contract_number = services_worker.contract_number
            INNER JOIN worker_nationality 
            ON worker_nationality.id = services_worker.worker_nationality_id
            INNER JOIN services_contract
            ON services_worker.contract_number = services_contract.contract_number
            INNER JOIN representatives
             ON services_contract.representative_id = representatives.id
            INNER JOIN staff 
            ON staff.id = services_worker.agent_id
        
            AND (contract.contract_date BETWEEN '2018-03-01' AND '2018-03-31')
            AND services_order.order_type_id = 4
            AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
            AND NOT services_finance.prepaid_money = '0.00'
             AND services_contract.representative_id = 3
        ";
        $query_result = $this->db->query($query);
        $payments = $query_result->result();
        echo '<pre>';
        print_r($payments);
        echo '</pre>';
    }

}