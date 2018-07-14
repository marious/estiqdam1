<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrival_airports extends MY_Controller
{

    public $module = 'arrival_airports';


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Arrival_airport_model');
        $this->adminSecurity();
        $this->load->library('form_validation');
    }


    public function index()
    {
        $this->data['arrival_airports'] = $this->Arrival_airport_model->get();
        $this->adminTemplate('index', $this->data);
    }


    public function add($id = null)
    {
        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['arrival_airport'] = $this->Arrival_airport_model->get($id);
            count($this->data['arrival_airport']) || redirect('arrival_airports/index');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['arrival_airport'] = $this->Arrival_airport_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        //$this->load->library('form_validation');
        $this->form_validation->set_rules($this->Arrival_airport_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Arrival_airport_model->array_from_post([
                'name_in_english',
                'name_in_arabic',
            ]);
            $this->Arrival_airport_model->save($data, $id);
            $message = ($id == null) ? 'New Arrival Airport Added Successfully' : 'Arrival Airport Added Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('arrival_airports');
        }

        $this->adminTemplate('add', $this->data);
    }



    public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Arrival_airport_model->delete($id);
        $this->session->set_flashdata('success', 'Arrival Airport Deleted Successfully');
        redirect('arrival_airports');
    }



    public function _unique_name_in_arabic($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('name_in_arabic', $this->input->post('name_in_arabic'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->Arrival_airport_model->get();
        if (count($item)) {
            $this->form_validation->set_message('_unique_name_in_arabic', '%s already exist please choose another one');
            return false;
        }
        return true;
    }


    public function _unique_name_in_english($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('name_in_english', $this->input->post('name_in_english'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->Arrival_airport_model->get();
        if (count($item)) {
            $this->form_validation->set_message('_unique_name_in_english', '%s already exist please choose another one');
            return false;
        }
        return true;
    }


}