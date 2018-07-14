<?php

class Transfer_type_model extends MY_Model
{
    protected $table_name = 'transfer_types';

    public $rules = [
        [
            'field' => 'type',
            'label' => 'Transfer Type',
            'rules' => 'trim|required',
        ]
    ];
}