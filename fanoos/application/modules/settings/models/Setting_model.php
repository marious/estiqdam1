<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends MY_Model 
{

    protected $table_name = 'settings';

    protected $timestamps = false;

    public $rules = [
      [
        'field' => 'en_website_title',
        'label' => 'lang:en_website_title',
        'rules' => 'trim',
      ],
      [
        'field' => 'ar_website_title',
        'label' => 'lang:ar_website_title',
        'rules' => 'trim',
      ],
      [
        'field' => 'en_meta_descriptions',
        'label' => 'lang:en_meta_descriptions',
        'rules' => 'trim',
      ],
      [
        'field' => 'ar_meta_descriptions',
        'label' => 'lang:ar_meta_descriptions',
        'rules' => 'trim',
      ],
      [
        'field' => 'en_meta_keywords',
        'label' => 'lang:en_meta_keywords',
        'rules' => 'trim',
      ],
      [
        'field' => 'ar_meta_keywords',
        'label' => 'lang:ar_meta_keywords',
        'rules' => 'trim',
      ],
      
    
    ];



    public function check_setting_exist($setting = '')
    {
        if (!empty($setting)) 
        {
            $query = $this->db->get_where($this->table_name, ['name' => $setting]);
            return $query->row() ? $query->row()->id : false;
        }

        return false;
    }

}