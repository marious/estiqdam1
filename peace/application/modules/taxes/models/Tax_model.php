<?php
class Tax_model extends MY_Model
{
    protected $table_name = 'tax';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'name',
            'label' => 'lang:name',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'rate',
            'label' => 'lang:rate',
            'rules' => 'trim|required|numeric',
        ],
        [
            'field' => 'tax_authority',
            'label' => 'lang:tax_authority',
            'rules' => 'trim|required|max_length[255]',
        ],
    ];
}
