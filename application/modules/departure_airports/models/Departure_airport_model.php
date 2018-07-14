<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departure_airport_model extends MY_Model
{

    protected $table_name = 'departure_airports';

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
        [
            'field' => 'nationality_id',
            'label' => 'Country Name',
            'rules' => 'trim|required',
        ]

    ];


    public function get_countries()
    {
        $this->load->module('worker_nationality');
        $countries = $this->worker_nationality->Worker_nationality_model->get();
        return $countries;
    }

}