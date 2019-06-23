<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->load->model('Permission_model');
    }



    public function add()
    {

        $this->data['page_header'] = lang('permissions');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('display_name', 'Permission Name', 'trim|required');
        if ($this->form_validation->run($this) == true)
        {
            if ($this->Permission_model->create_permission($this->input->post('display_name')))
            {
                $_SESSION['success'] = 'Permission Added Successfully';
                $this->session->mark_as_flash('success');
                redirect('permissions/add');
            }
        }
        $this->admin_template('add',  $this->data);
    }

}