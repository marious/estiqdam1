<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_nationality_model extends MY_Model
{

    protected $table_name = 'customer_nationality';

    public $rules = [
        [
            'field' => 'nationality_in_english',
            'label' => 'Nationality In English',
            'rules' => 'trim|required|callback__unique_nationality_in_english',
        ],
        [
            'field' => 'nationality_in_arabic',
            'label' => 'Nationality In Arabic',
            'rules' => 'trim|required|callback__unique_nationality_in_arabic',
        ],
        [
            'field' => 'country_name_in_arabic',
            'label' => 'Country Name In Arabic',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'country_name_in_english',
            'label' => 'Country Name In English',
            'rules' => 'trim|required',
        ],
    ];

}