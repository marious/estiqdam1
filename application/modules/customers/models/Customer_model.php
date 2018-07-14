<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends MY_Model
{

    protected $table_name = 'customers';

    public $rules = [
        [
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'password_confirm',
            'label' => 'lang:confirm_password',
            'rules' => 'trim|required|matches[password]',
        ],
        [
            'field' => 'customer_name_in_arabic',
            'label' => 'lang:customer_name_in_arabic',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'customer_name_in_english',
            'label' => 'lang:customer_name_in_english',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'customer_id',
            'label' => 'lang:customer_id',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'nationality_id',
            'label' => 'lang:customer_nationality',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'customer_mobile',
            'label' => 'lang:customer_mobile',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'visa_number',
            'label' => 'lang:visa_number',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'visa_date',
            'label' => 'lang:visa_date',
            'rules' => 'trim|required',
        ],

    ];


    public function get_rules_without_password()
    {
        return  [
        [
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'customer_name_in_arabic',
            'label' => 'lang:customer_name_in_arabic',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'customer_name_in_english',
            'label' => 'lang:customer_name_in_english',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'customer_nationality_id',
            'label' => 'lang:customer_nationality_id',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'customer_mobile',
            'label' => 'lang:customer_mobile',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'visa_number',
            'label' => 'lang:visa_number',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'visa_date',
            'label' => 'lang:visa_date',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'nationality_id',
            'label' => 'lang:customer_nationality',
            'rules' => 'trim|required',
        ],
            [
                'field' => 'customer_id',
                'label' => 'lang:customer_id',
                'rules' =>'trim|required',
            ],

    ]   ;
    }


    public function get_customer_nationality_id($customer_id)
    {
        $sql = "SELECT staff.nationality_id 
                from staff WHERE staff.id = ?
              ";
        $query = $this->db->query($sql, array($customer_id));
        if ($query->num_rows())
        {
            return $query->row()->nationality_id;
        }

    }


}