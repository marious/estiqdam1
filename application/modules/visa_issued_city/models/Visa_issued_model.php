<?php

class Visa_issued_model extends MY_Model
{

    protected $table_name = 'visa_issued_city';


    public $rules = [
        [
            'field' => 'city',
            'label' => 'City Name',
            'rules' => 'trim|required',
        ]
    ];

}