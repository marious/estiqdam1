<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('max_input_vars', '3000');
        $this->load->library('form_builder');
        $this->load->model('Setting_model');
        $this->lang->load('settings');
    }

    public function index()
    {
        $tab = $this->input->get('tab');
        $tab_view = explode('/', $tab);
        $form = $this->form_builder->create_form();

        if (!$this->input->get('tab'))
        {
            $view = 'company';
            $tab = 'company';
            $data = '';
        }
        elseif ($tab_view[0] == 'language')
        {

        }
        else
        {
            $tab = $tab_view[0];
            $view = $tab_view[0];
            $data = '';
        }


        if ($tab_view[0] == 'localization')
        {
            $data['countries'] = $this->db->get('countries')->result();
            $data['timezones'] = $this->Setting_model->timezones();
        }

        $data['tab'] = $tab;
        $data['form'] = $form;
        $this->data['tab'] = $tab;
        $this->data['tab_view'] = $this->load->view('settings/includes/'.$view, $data, true);
        $this->data['form'] = $form;

        $this->admin_template('index', $this->data);
    }


    public function save_settings()
    {
        $settings = $this->input->post('settings');
        $tab = $this->input->post('tab');

        if (!empty($settings))
        {
            foreach ($settings as $id => $setting) {
                $this->form_validation->set_rules('settings['.$id.']', lang($id), 'required|trim');
            }
        }

        if ($this->form_validation->run() == TRUE)
        {
            foreach ($settings as $name => $val)
            {
                $this->db->where('name', $name);
                $exists = $this->db->count_all_results('settings');
                if ($exists == 0)
                {
                    $this->db->insert('settings', ['name' => $name]);
                }

                $this->db->where('name', $name);
                $this->db->update('settings', ['value' => $val]);
            }

            $this->message->save_success('settings?tab='.$tab);
        }
        else
        {
            // Errors
            $error = validation_errors();

            $this->message->custom_error_msg('settings?tab='.$tab ,$error);
        }

    }
}