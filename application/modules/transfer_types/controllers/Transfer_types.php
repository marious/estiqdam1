<?php

class Transfer_types extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transfer_type_model');
        $this->adminSecurity();
        modules::run('site_security/_make_sure_is_admin');
    }

    public function index()
    {
        $this->data['transfer_types'] = $this->Transfer_type_model->get();

        $this->adminTemplate('index', $this->data);
    }


    public function add($id = null)
    {
        // Fetch one or set a new one
        if ($id && is_numeric($id))
        {
            $this->data['transfer_type'] = $this->Transfer_type_model->get($id);
            count($this->data['transfer_type']) || redirect('transfer_types');
            $this->data['id'] = $id;        // flag to use in a view
        }
        else if ($id == null)
        {
            $this->data['transfer_type'] = $this->Transfer_type_model->get_new();
            $this->data['id'] = false;
        }

        $this->data['transfer_types'] = $this->Transfer_type_model->get_by(array('parent_id' => 0));

        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Transfer_type_model->rules);
        if ($this->form_validation->run($this) == true)
        {

            $data = $this->Transfer_type_model->array_from_post([
                'type',
                'parent_id',
            ]);
            $this->Transfer_type_model->save($data, $id);
            $message = ($id == null) ? 'New Transfer Type added Successfully' : 'Transfer Type Updated Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('transfer_types');
        }


        $this->adminTemplate('add', $this->data);
    }


    public function get_type_by_id($id)
    {
        if ($id)
        {
            $type = $this->Transfer_type_model->get_by(array('id' => $id), true);
            return $type->type;
        }
    }
}