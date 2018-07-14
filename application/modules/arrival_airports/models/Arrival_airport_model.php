<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrival_airport_model extends MY_Model
{

    protected $table_name = 'arrival_airports';

    public $rules = [
        [
            'field' => 'name_in_english',
            'label' => 'Name In English',
            'rules' => 'trim|required|callback__unique_name_in_english',
        ],
        [
            'field' => 'name_in_arabic',
            'label' => 'Name In Arabic',
            'rules' => 'trim|required|callback__unique_name_in_arabic',
        ],

    ];

}