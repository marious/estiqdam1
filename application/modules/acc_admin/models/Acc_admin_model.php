<?php

class Acc_admin_model extends MY_Model
{
    protected $table_name = 'accounts';

    public function get_all_accounts()
    {
        $this->db->select('*');
        $this->db->from('accounts');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    //get Chart Of Accounts by type
    public function get_chart_of_account_type($type)
    {
        $this->db->select('*');
        $this->db->from('chart_of_accounts');
        $this->db->where('accounts_type', $type);
        $query_result = $this->db->get();
        return $query_result->result();
    }

    //get all Chart Of Accounts
    public function get_all_chart_of_accounts(){
        $this->db->select('*');
        $this->db->from('chart_of_accounts');
        $this->db->order_by("chart_id", "desc");
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }


//get Chart Of Accounts by type
    public function get_chart_of_account_by_type($type){
        $this->db->select('*');
        $this->db->from('chart_of_accounts');
        $this->db->where('accounts_type',$type);
//        $this->db->where("user_id",$this->session->userdata('user_id'));
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;

    }

    //get payer and payee by type
    public function get_payer_and_payee_by_type($type)
    {
        $this->db->select('*');
        $this->db->from('payee_payers');
        $this->db->where('type', $type);
        $query_result = $this->db->get();
        return $query_result->result();
    }


    //get all payment method
    public function get_all_payment_method()
    {
        $this->db->select('*');
        $this->db->from('payment_method');
        $this->db->order_by('p_method_id', 'desc');
        $query_result = $this->db->get();
        return $query_result->result();
    }




    //get transaction informatio
    public function get_transaction($limit = '', $type = '')
    {
        $this->db->select('*');
        $this->db->from('transaction');

        if ($type != '')
        {
            $this->db->where('type', $type);
        }
        $this->db->order_by('trans_date', 'desc');
        if ($limit != 'all')
        {
            $this->db->limit($limit);
        }
        $query_result = $this->db->get();
        return $query_result->result();
    }



    public function get_all_payer_and_payee()
    {
        $this->db->select('*');
        $this->db->from('payee_payers');
//        $this->db->where("user_id",$this->session->userdata('user_id'));
        $this->db->order_by("trace_id", "desc");
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }


//method for calculating balance
    public function get_balance($account,$amount,$action)
    {
        if ($action == 'add')
        {
            // get last balance
            $query=$this->db->query("SELECT bal FROM transaction WHERE accounts_name= '".$account."' ORDER BY
                    trans_id DESC LIMIT 1");
            $result=$query->row();
            return $result->bal + $amount;
        }
        else if ($action == 'sub')
        {
            //get last balance
            $query=$this->db->query("SELECT bal FROM transaction 
WHERE accounts_name='".$account."' ORDER BY
trans_id DESC LIMIT 1");
            $result=$query->row();
            return $result->bal - $amount;
        }
    }


    //get single transaction
    public function get_single_transaction($trans_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('trans_id',$trans_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }


}