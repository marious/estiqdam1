<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanazul_model extends MY_Model
{

    protected $table_name = 'tanazul';

    public $rules = [
        [
            'field' => 'adv_text',
            'label' => 'نص الاعلان',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'mobile_number',
            'label' => 'رقم التواصل',
            'rules' => 'trim|required',
        ],
    ];



}