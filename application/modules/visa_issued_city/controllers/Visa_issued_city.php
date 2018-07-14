<?php

class Visa_issued_city extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Visa_issued_model');
        $this->adminSecurity();
    }


    public function index()
    {
        $this->data['cities'] = $this->Visa_issued_model->get();
        $this->adminTemplate('index', $this->data);
    }


    public function add($id = null)
    {
        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['city'] = $this->Visa_issued_model->get($id);
            count($this->data['city']) || redirect('visa_issued_city');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['city'] = $this->Visa_issued_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Visa_issued_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Visa_issued_model->array_from_post([
                'city',
            ]);
            $this->Visa_issued_model->save($data, $id);
            $message = ($id == null) ? 'New Visa Issued City Added Successfully' : 'Visa Issued City Updated Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('visa_issued_city');
        }

        $this->adminTemplate('add', $this->data);
    }



    public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Visa_issued_model->delete($id);
        $this->session->set_flashdata('success', 'Visa Issued City Deleted Successfully');
        redirect('visa_issued_city');
    }


}