<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_type_model extends MY_Model 
{
	protected $table_name = 'order_types';

	 public $rules = [
        [
            'field' => 'name_in_english',
            'label' => 'Order Type In English',
            'rules' => 'trim|required|callback__unique_order_name_in_english',
        ],
         [
            'field' => 'name_in_arabic',
            'label' => 'Order Type In Arabic',
            'rules' => 'trim|required|callback__unique_order_name_in_arabic',
        ],
    ];
     
}