<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends MY_Controller 
{

	public function test()
	{
		$data = "";
		$this->public_jqm($data);
	}




	public function public_bootstrap($data)
	{
		$this->load->view('public_bootstrap', $data);
	}

	public function public_jqm($data)
	{
		$this->load->view('public_jqm', $data);
	}

	public function admin($data)
	{
		$this->load->view('admin', $data);
	}


	public function accountant($data)
    {
        $this->load->view('includes/accountant_header');
        $this->load->view('accountant', $data);
        $this->load->view('includes/accountant_footer');
    }
}

/* End of file Templates.php */
/* Location: ./application/modules/templates/controllers/Templates.php */