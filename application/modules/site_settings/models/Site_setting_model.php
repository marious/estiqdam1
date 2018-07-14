<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_setting_model extends MY_Model
{
    protected $table_name = 'institution_details';

    public $rules = [
        [
            'field' => 'name_in_english',
            'label' => 'Name In English',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'name_in_arabic',
            'label' => 'Name In Arabic',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'phone',
            'label' => 'Phone Number',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile Number',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'fax',
            'label' => 'Fax Number',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'email',
            'label' => 'Email Address',
            'rules' => 'trim|required|valid_email',
        ],
        [
            'field' => 'address_in_english',
            'label' => 'Address In English',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'address_in_arabic',
            'label' => 'Address In Arabic',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'licence_number',
            'label' => 'Licence Number',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'commercial_licence',
            'label' => 'Commercial Licence',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'website',
            'label' => 'Website',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'tax_amount',
            'label' => 'Tax Amount',
            'rules' => 'trim|required',
        ]
    ];
}