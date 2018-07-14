<?php

class Credit_card_model extends MY_Model
{

    protected $table_name = 'credit_card';


    public $rules = [
        [
            'field' => 'credit_card',
            'label' => 'Credit Card Number',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'credit_card_amount',
            'label' => 'Credit Card Amount',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'payment_amount',
            'label' => 'Payment Amount',
            'rules' => 'trim|required|numeric',
        ],
    ];

}