<?php

class Customers_payment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Customer_payment_model');
    }



    public function make_payment($customer_id, $visa_number, $contract_number ,$payment_amount, $payment_date = false, $transfer_type = 0)
    {
        if ($payment_date == false)
        {
            $payment_date = date('Y-m-d H:i:s');
        }
        $payment_number=  $this->get_payment_number();
        return $this->Customer_payment_model->save(array(
            'customer_id'       => $customer_id,
            'visa_number'       => $visa_number,
            'contract_number'   => $contract_number,
            'payment_amount'    => $payment_amount,
            'payment_number'    => $payment_number,
            'payment_date'      => $payment_date,
            'transfer_type'     => $transfer_type,
        ));
    }




    public function check_existance_visa_number($visa_number)
    {
       return $this->Customer_payment_model->get_by(array('visa_number' => $visa_number), true);
    }



    public function get_payment_number()
    {
        return $this->get_random_unique_6_digit();
    }



    public function get_random_unique_6_digit()
    {
        $payment_number = 0;
        for ($i = 0; $i < 10; $i++) {
            $number = $this->get_random_6_digit();
            if ($this->check_existance_number($number) == false)
            {
                $payment_number = $number;
                break;
            }
        }
        return $payment_number;
    }

    public function get_random_6_digit()
    {
        return mt_rand(100000, 999999);
    }


    public function check_existance_number($number)
    {
        $exist = $this->Customer_payment_model->get_by(array('payment_number' => $number), true);
        if ($exist && count($exist))
        {
            return true;
        }
        return false;
    }
}