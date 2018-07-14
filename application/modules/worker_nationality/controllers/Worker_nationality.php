<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker_nationality extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Worker_nationality_model');
    }


    public function index()
    {
        $this->adminSecurity();

        $this->data['worker_nationalities'] = $this->Worker_nationality_model->get();
        $this->adminTemplate('index', $this->data);

    }



    public function add($id = null)
    {
        $this->adminSecurity();

        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['worker_nationality'] = $this->Worker_nationality_model->get($id);
            count($this->data['worker_nationality']) || redirect('worker_nationality');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['worker_nationality'] = $this->Worker_nationality_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Worker_nationality_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Worker_nationality_model->array_from_post([
                'nationality_in_english',
                'nationality_in_arabic',
                'country_name_in_english',
                'country_name_in_arabic',
            ]);
            $this->Worker_nationality_model->save($data, $id);
            $message = ($id == null) ? 'New Worker Nationality Added Successfully' : 'Worker Nationality Added Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('worker_nationality');
        }

        $this->adminTemplate('add', $this->data);

    }



    public function delete($id = null)
    {
        $this->adminSecurity();

        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Worker_nationality_model->delete($id);
        $this->session->set_flashdata('success', 'Worker Nationality Deleted Successfully');
        redirect('worker_nationality');
    }




    public function _unique_nationality_in_arabic($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('nationality_in_arabic', $this->input->post('nationality_in_arabic'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->Worker_nationality_model->get();
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
        $item = $this->Worker_nationality_model->get();
        if (count($item)) {
            $this->form_validation->set_message('_unique_nationality_in_english', '%s already exist please choose another one');
            return false;
        }
        return true;
    }


}