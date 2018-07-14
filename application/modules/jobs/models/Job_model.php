<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends MY_Model 
{
	protected $table_name = 'jobs';

	 public $rules = [
        [
            'field' => 'name_in_english',
            'label' => 'Job Name In English',
            'rules' => 'trim|required|callback__unique_job_name_in_english',
        ],
         [
            'field' => 'name_in_arabic',
            'label' => 'Job Name In Arabic',
            'rules' => 'trim|required|callback__unique_job_name_in_arabic',
        ],
    ];
     
}