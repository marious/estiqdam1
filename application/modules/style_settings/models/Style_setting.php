<?php

class Style_setting extends MY_Model
{
    protected $table_name = 'style_settings';

    public $rules = [
        [
            'field' => 'contract_1_top_margin',
            'label' => 'Contract 1 Top Margin',
            'rules' => 'trim|required|numeric',
        ],
        [
            'field' => 'contract_2_top_margin',
            'label' => 'Contract 2 Top Margin',
            'rules' => 'trim|required|numeric',
        ]
    ];
}