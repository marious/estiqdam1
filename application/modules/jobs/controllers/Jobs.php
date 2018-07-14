<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MY_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Job_model');
	}


	public function index()
	{
        $this->adminSecurity();

        $this->data['jobs'] = $this->Job_model->get();
        $this->adminTemplate('index', $this->data);
	}


	public function add($id = null)
	{
        $this->adminSecurity();


        // Fetch one or set new one
		if ($id && is_numeric($id))
		{
		    $this->data['job'] = $this->Job_model->get($id);
		    count($this->data['job']) || redirect('jobs');
		    $this->data['id'] = $id;    // flag to used in view
		}
		else if ($id == null)
		{
		    $this->data['job'] = $this->Job_model->get_new();
		    $this->data['id'] = false;
		}

		// process the form
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->Job_model->rules);
		if ($this->form_validation->run($this) == true)
		{
		    $data = $this->Job_model->array_from_post([
		        'name_in_english', 'name_in_arabic',
		    ]);
		    $this->Job_model->save($data, $id);
		    $message = ($id == null) ? 'New Job Name Added Successfully' : 'Job Name Added Successfully';
		    $this->session->set_flashdata('success', $message);
		    redirect('jobs');
		}

		$this->adminTemplate('add', $this->data);

	}


	public function delete($id = null)
	{
        $this->adminSecurity();

        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
		// delete item
		$this->Job_model->delete($id);
		$this->session->set_flashdata('success', 'Job Deleted Successfully');
		redirect('jobs');
	}




	public function _unique_job_name_in_english($str)
	{
		$id = $this->uri->segment(3);
		$this->db->where('name_in_english', $this->input->post('name_in_english'));
		!$id || $this->db->where('id !=', $id);
		$item = $this->Job_model->get();
		if (count($item)) {
		    $this->form_validation->set_message('_unique_job_name_in_english', '%s already exist please choose another one');
		    return false;
		}
		return true;
	}



	public function _unique_job_name_in_arabic($str)
	{
		$id = $this->uri->segment(3);
		$this->db->where('name_in_arabic', $this->input->post('name_in_arabic'));
		!$id || $this->db->where('id !=', $id);
		$item = $this->Job_model->get();
		if (count($item)) {
		    $this->form_validation->set_message('_unique_job_name_in_arabic', '%s already exist please choose another one');
		    return false;
		}
		return true;
	}

}