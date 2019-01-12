<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('staff/Staff_model');
	}



    public function login_customer()
    {
        $validation_rules = [
            [
                'field' => 'customer_name',
                'label' => 'اسم المتخدم',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => 'الرقم السرى',
                'rules' => 'trim|required',
            ]
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run($this) == true) {
            $user = $this->Staff_model->do_login_customer($this->input->post('customer_name'), $this->input->post('password'));
            if ($user && count($user))
            {
                redirect(site_url('home'));
            }
            $this->session->set_flashdata('error_message', 'Invalid Username or password');
			redirect('home/login', 301);
        }
    }


	public function login()
	{
	    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && in_array($_SESSION['access_id'], array(1,2)))
        {
            redirect('services_entry');
        }



        $this->data['username'] = isset($_GET['user']) && $_GET['user'] == 'demo' ? 'demo' : '';
        $this->data['password'] = isset($_GET['user']) && $_GET['user'] == 'demo' ? 'password' : '';

//		$this->load->library('cicaptcha');
//		$this->data['cicaptcha_html'] = $this->cicaptcha->show();
//		$this->data['cicaptcha_html'];


		$validation_rules = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required',
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required',
			]
		];

		// process the form 
		$this->load->library('form_validation');
		$this->form_validation->set_rules($validation_rules);

		if ($this->form_validation->run($this) == true)
		{
//			if( $this->cicaptcha->validate()===false ){
//			  $this->session->set_flashdata('error_message', 'incorrect captcha');
//			  // $this->session->set_userdata(array(
//			  //   '_POST_DATA' => $_POST,
//			  // ));
//			  redirect("admin/login", 301 );
//			}
//
			$user = $this->Staff_model->do_login($this->input->post('username'), $this->input->post('password'));
			
			if ($user && count($user)) {
			    log_message('custom', 'User: ' .  $user->username . ' has beend logged at ' . date('Y-m-d H:i'));
				redirect('services_entry');
			}
			
			$this->session->set_flashdata('error_message', 'Invalid Username or password');
			redirect('admin/login', 301);

		}

		$this->load->view('login', $this->data);
	}


	public function logout()
	{
		$this->Staff_model->logout();
		redirect(site_url('home'));
	}

	public function logout_customer()
    {
        $this->Staff_model->logout();
        redirect(site_url());
    }


	public function _hash_string($str)
	{
		$hashed_string = password_hash($str, PASSWORD_BCRYPT, [
			'cost' => 11,
		]);
		return $hashed_string;
	}


	public function _verify_hash($plain_text_str, $hashed_string)
	{
		$result = password_verify($plain_text_str, $hashed_string);
		return $result;
	}


	/**
	 * Make sure the user logged is admin user
	 */
	public function _make_sure_is_admin()
	{
		if (! isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true && !in_array($_SESSION['access_id'], array(1,2)))
		{
			redirect('admin/login');
		}

		// $is_admin = TRUE;

		// if (!$is_admin)
		// {
		// 	redirect(static::ADMIN_NOTALLOWED_REDIRECT);
		// }
	}







	public function not_allowed()
	{
		echo 'You are not allowed to be here.';
	}

}
