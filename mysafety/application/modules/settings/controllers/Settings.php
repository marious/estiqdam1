<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller 
{



    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->lang->load('settings');
        $this->load->model('Setting_model');
    }


    public function index()
    {
        $this->data['page_header'] = lang('settings');
        $this->admin_template('index', $this->data);
    }




    public function add()
    {
        // Process the form 
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Setting_model->rules);
        if ($this->form_validation->run($this) == TRUE)
        {

            // check if the setting post exist
            foreach ($_POST as $setting_name => $value) {

                // check if the setting  is logo
                if (isset($_FILES['logo']))
                {
                    $_SESSION['active_tab'] = 'logo';

                    if ($file = $this->Setting_model->do_upload($this->Setting_model->upload_path, 'logo',
                    ['width' => 700, 'height' => 500, 'destination' => 'assets/uploads'])) {
                        $file_path = substr($file['full_path'], strpos($file['full_path'], 'assets'));
                        $this->make_setting('logo', $file_path);
                        $_SESSION['success'] = lang('logo_uploaded_successfully');
                        $this->session->mark_as_flash('success');
                    } else {
                        $this->session->mark_as_flash('error');
                    }
                    redirect('settings');

                }
                else
                {
                    $this->set_session_active_tab($setting_name);
                    $this->make_setting($setting_name, $value);
                }

            }
        } 
        $_SESSION['success'] = lang('success_sended_data');
        $this->session->mark_as_flash('success');
        redirect('settings');
    }


    protected function make_setting($setting_name, $value)
    {
        if ($setting_id = $this->Setting_model->check_setting_exist($setting_name)) {
            // update
            $this->Setting_model->save(['value' => $value], $setting_id);
        } else {
            // create a new one
            $this->Setting_model->save(['name' => $setting_name, 'value' => $value]);
        }
    }


    protected function set_session_active_tab($setting_name = '')
    {
        if ($setting_name == 'en_contact_address') {
            $_SESSION['active_tab'] = 'general_content';
            return;
        } else if ($setting_name == 'facebook') {
            $_SESSION['active_tab'] = 'social_media';
        }
        return;
    }





}