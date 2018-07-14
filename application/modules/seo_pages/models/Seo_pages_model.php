<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_pages_model extends MY_Model
{

    protected $table_name = 'seo_pages';

    public $rules = [
        [
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'trim|required',
        ],
    ];



}