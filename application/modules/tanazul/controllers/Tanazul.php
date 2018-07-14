<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tanazul extends MY_Controller
{
    public $module = 'tanazul';


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tanazul_model');
        $this->adminSecurity();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['advs'] = $this->Tanazul_model->get();
        $this->adminTemplate('index', $this->data);
    }


    public function add($id = null)
    {
        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['tanazul'] = $this->Tanazul_model->get($id);
            count($this->data['tanazul']) || redirect('tanazul/index');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['tanazul'] = $this->Tanazul_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        //$this->load->library('form_validation');
        $this->form_validation->set_rules($this->Tanazul_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Tanazul_model->array_from_post([
                'adv_text',
                'mobile_number',
            ]);
            $this->Tanazul_model->save($data, $id);
            $message = ($id == null) ? 'New Tanazul Added Successfully' : 'Tanazul Updated Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('tanazul');
        }

        $this->adminTemplate('add', $this->data);
    }



    public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Tanazul_model->delete($id);
        $this->session->set_flashdata('success', 'Tanazul Deleted Successfully');
        redirect('tanazul');
    }

}