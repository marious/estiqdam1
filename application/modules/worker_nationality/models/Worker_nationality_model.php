<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker_Nationality_Model extends MY_Model
{

    protected $table_name = 'worker_nationality';

    public $rules = [
        [
            'field' => 'nationality_in_english',
            'label' => 'Nationality In English',
            'rules' => 'trim|required|callback__unique_nationality_in_english',
        ],
        [
            'field' => 'nationality_in_arabic',
            'label' => 'Nationality In Arabic',
            'rules' => 'trim|required|callback__unique_nationality_in_arabic',
        ],
        [
            'field' => 'country_name_in_arabic',
            'label' => 'Country Name In Arabic',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'country_name_in_english',
            'label' => 'Country Name In English',
            'rules' => 'trim|required',
        ],
    ];



    public function get_ordered()
    {
        $sql  = "SELECT * FROM worker_nationality WHERE show_in_site='1' ORDER BY order_in_site";
        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }

}