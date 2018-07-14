<?php

class Style_settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Style_setting');
    }

    public function index($id = 1)
    {
        $style_settings = $this->Style_setting->get(1, true);

        if ($style_settings && count($style_settings))
        {
            $this->data['style_settings'] = $style_settings;
        }
        else
        {
            $this->data['style_settings'] = $this->Style_setting->get_new();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Style_setting->rules);

        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Style_setting->array_from_post([
                'contract_1_top_margin',
                'contract_2_top_margin',
            ]);

            $this->Style_setting->save($data, $id);
            
            $this->session->set_flashdata('success', lang('success_save'));
            redirect('style_settings');
        }

        $this->adminTemplate('index', $this->data);
    }


}