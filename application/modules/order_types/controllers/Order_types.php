<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_types extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Order_type_model');
		$this->adminSecurity();
	}


	public function index()
	{
		$this->data['order_types'] = $this->Order_type_model->get();
        $this->adminTemplate('index', $this->data);
	}



	public function add($id = null)
	{
		// Fetch one or set new one
		if ($id && is_numeric($id))
		{
		    $this->data['order_type'] = $this->Order_type_model->get($id);
		    count($this->data['order_type']) || redirect('order_types');
		    $this->data['id'] = $id;    // flag to used in view
		}
		else if ($id == null)
		{
		    $this->data['order_type'] = $this->Order_type_model->get_new();
		    $this->data['id'] = false;
		}

		// process the form
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->Order_type_model->rules);
		if ($this->form_validation->run($this) == true)
		{
		    $data = $this->Order_type_model->array_from_post([
		        'name_in_english', 'name_in_arabic',
		    ]);
		    $this->Order_type_model->save($data, $id);
		    $message = ($id == null) ? 'New Order Type Added Successfully' : 'Order Type Added Successfully';
		    $this->session->set_flashdata('success', $message);
		    redirect('order_types');
		}

		$this->adminTemplate('add', $this->data);
	}




	public function _unique_order_name_in_english($str)
	{
		$id = $this->uri->segment(3);
		$this->db->where('name_in_english', $this->input->post('name_in_english'));
		!$id || $this->db->where('id !=', $id);
		$item = $this->Order_type_model->get();
		if (count($item)) {
		    $this->form_validation->set_message('_unique_order_name_in_english', '%s already exist please choose another one');
		    return false;
		}
		return true;
	}



	public function delete($id = null)
	{
		$id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
		// delete item
		$this->Order_type_model->delete($id);
		$this->session->set_flashdata('success', 'Order Type Deleted Successfully');
		redirect('order_types');
	}



	public function _unique_order_name_in_arabic($str)
	{
		$id = $this->uri->segment(3);
		$this->db->where('name_in_arabic', $this->input->post('name_in_arabic'));
		!$id || $this->db->where('id !=', $id);
		$item = $this->Order_type_model->get();
		if (count($item)) {
		    $this->form_validation->set_message('_unique_order_name_in_arabic', '%s already exist please choose another one');
		    return false;
		}
		return true;
	}
}