<?php

class Staff extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Staff_model');
        $this->adminSecurity();
    }


    public function index()
    {
        $this->data['staff'] = $this->Staff_model->get_staff();

        $this->adminTemplate('index', $this->data);
    }



    public function add_user_staff($id = null)
    {
        $this->lang->load('services_entry');
        $this->load->module('services_entry');
        $this->data['customer_nationalities'] = $this->services_entry->get_customer_nationalities();
        $this->data['worker_nationalities'] = $this->services_entry->get_worker_nationalities();
        $this->data['arrival_airports'] = $this->services_entry->get_arrival_airports();
        $this->data['worker_jobs'] = $this->services_entry->get_worker_jobs();
        $this->data['visa_issued_city'] = $this->services_entry->get_visa_issued_cities();

        $access_levels = $this->Staff_model->get_user_access_levels();
        $options = [];
        foreach($access_levels as $level) {
            $options[$level->id] = $level->access;
        }
        $this->data['options'] = $options;

        // Fetch one or set a new one
        if ($id && is_numeric($id))
        {
            $this->data['staff'] = $this->Staff_model->get($id);
            count($this->data['staff']) || redirect('staff/index');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['staff'] = $this->Staff_model->get_new();
            $this->data['id'] = false;
        }

        // Setup form
        $this->load->library('form_validation');

        // process the form

        if (null != $id) {
            if (isset($_POST['password']) && $_POST['password'] == '') {
                $rules = $this->Staff_model->get_rules_without_password();
            } else {
                $rules = $this->Staff_model->get_rules_without_password();
            }
        } else {
            $rules = $this->Staff_model->get_rules();
        }

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Staff_model->array_from_post([
                'username', 'access_id', 'user_language',
            ]);
            if (!$id)
            {
                $data['password'] = $this->admin->_hash_string($this->input->post('password'));
            } else if($this->input->post('password') != '') {
                $data['password'] = $this->admin->_hash_string($this->input->post('password'));
            }
            $this->Staff_model->save($data, $id);
            $message = ($id == null) ? 'New Staff User Added Successfully' : 'Staff User Updated Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('staff/index');
        }


        $this->adminTemplate('add', $this->data);
    }










    public function delete($id)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Staff_model->delete($id);
        $this->session->set_flashdata('success', 'Staff User Deleted Successfully');
        redirect('staff');
    }


    public function _unique_username($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('username', $this->input->post('username'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->Staff_model->get();
        if (count($item)) {
            $this->form_validation->set_message('_unique_username', '%s already exist please choose another one');
            return false;
        }
        return true;
    }
}

