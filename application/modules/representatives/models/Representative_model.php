<?php 

class Representative_model extends MY_Model
{

	protected $table_name = 'representatives';

    public $rules = [
        [
            'field' => 'name',
            'label' => 'Representative Name',
            'rules' => 'trim|required',
        ],
    ];

}