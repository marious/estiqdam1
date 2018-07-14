<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_card extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Credit_card_model');
        $this->adminSecurity();
    }


    public function index()
    {
        $this->data['credit_cards'] = $this->Credit_card_model->get();
        $this->adminTemplate('index', $this->data);
    }


    public function add($id = null)
    {
        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['credit_card'] = $this->Credit_card_model->get($id);
            count($this->data['credit_card']) || redirect('credit_card');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['credit_card'] = $this->Credit_card_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Credit_card_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Credit_card_model->array_from_post([
                'credit_card',
                'credit_card_amount',
                'payment_amount'
            ]);
            $this->Credit_card_model->save($data, $id);
            $message = ($id == null) ? 'New Credit card Added Successfully' : 'Credit Card Updated Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('credit_card');
        }

        $this->adminTemplate('add', $this->data);

    }



    public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Credit_card_model->delete($id);
        $this->session->set_flashdata('success', 'Credit Card Deleted Successfully');
        redirect('credit_card');
    }

}