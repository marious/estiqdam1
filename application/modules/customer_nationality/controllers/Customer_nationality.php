<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_nationality extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_nationality_model');
        $this->adminSecurity();
    }


    public function index()
    {
        $this->data['customer_nationalities'] = $this->Customer_nationality_model->get();
        $this->adminTemplate('index', $this->data);

    }



    public function add($id = null)
    {
        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['customer_nationality'] = $this->Customer_nationality_model->get($id);
            count($this->data['customer_nationality']) || redirect('customer_nationality');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['customer_nationality'] = $this->Customer_nationality_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Customer_nationality_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Customer_nationality_model->array_from_post([
                'nationality_in_english',
                'nationality_in_arabic',
                'country_name_in_english',
                'country_name_in_arabic',
            ]);
            $this->Customer_nationality_model->save($data, $id);
            $message = ($id == null) ? 'New customer Nationality Added Successfully' : 'customer Nationality Added Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('customer_nationality');
        }

        $this->adminTemplate('add', $this->data);

    }



    public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Customer_nationality_model->delete($id);
        $this->session->set_flashdata('success', 'customer Nationality Deleted Successfully');
        redirect('customer_nationality');
    }




    public function _unique_nationality_in_arabic($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('nationality_in_arabic', $this->input->post('nationality_in_arabic'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->Customer_nationality_model->get();
        if (count($item)) {
            $this->form_validation->set_message('_unique_nationality_in_arabic', '%s already exist please choose another one');
            return false;
        }
        return true;
    }


    public function _unique_nationality_in_english($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('nationality_in_english', $this->input->post('nationality_in_english'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->Customer_nationality_model->get();
        if (count($item)) {
            $this->form_validation->set_message('_unique_nationality_in_english', '%s already exist please choose another one');
            return false;
        }
        return true;
    }


}