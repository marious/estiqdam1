<?php
class Currency_model extends MY_Model
{
    protected $table_name = 'currencies';
    protected $timestamps = true;

    public $rules =  [
        [
            'field' => 'code',
            'label' => 'lang:currency_code',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'symbol',
            'label' => 'currency_symbol',
            'rules' => 'trim|required',
        ],
    ];
}