<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	const ADMIN_NOTALLOWED_REDIRECT = 'site_security/not_allowed';

	public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->library('config');
        $this->load->module('templates');

        if (!isset($this->data['view_module']))
            {
            $this->data['view_module'] = $this->uri->segment(1);
        }
        if (!isset($_SESSION['language']) || empty($_SESSION['language']))
        {
            if (isset($_SESSION['user_language']) && !empty($_SESSION['user_language'])) {
                $_SESSION['language'] = get_language($_SESSION['user_language']);
                $this->config->set_item('language', $_SESSION['language']);
            } else {
                $this->config->set_item('language', 'arabic');
            }
        }
        else
        {
            if (isset($_SESSION['language']))
            {
                $this->config->set_item('language', $_SESSION['language']);
            }
        }

//        if (!isset($_SESSION['public_site_language']) || empty($_SESSION['public_site_language']))
//        {
//            $this->config->set_item('language', 'arabic');
//
////            if (isset($_SESSION['user_language'])) {
////                $_SESSION['language'] = get_language($_SESSION['user_language']);
////                $this->config->set_item('language', $_SESSION['language']);
////            }
//        }
//        else
//        {
//            if (isset($_SESSION['public_site_language']))
//            {
//                $this->config->set_item('language', $_SESSION['public_site_language']);
//            }
//        }
//

        if (isset($_SESSION['access_id']) && $_SESSION['access_id'] == 4)
        {
            // Agent allowed
            if (! in_array($this->uri->segment(1), get_agent_allowed_url()))
            {
                redirect(site_url('dashboard'));
            }
        }

        $this->lang->load('general');
        $this->data['datatables'] = false;       // flag used to load datatables resources
    }


    public function check_permission()
    {
        if ($_SESSION['permission_role'] == 'user')
        {
            return redirect('404');
        }
        return true;
    }

	/**
	 * admin template view 
	 * @param string view file 
	 * @param array $data
	 */
	protected function adminTemplate($view_file, $data)
	{
		$data['view_file'] = $view_file;
		$this->templates->admin($data);
	}


    /**
     * Accountant Template view
     * @param $view_file
     * @param $data
     */
	public function accountantTemplate($view_file, $data)
    {
        $data['view_file'] = $view_file;
        $this->templates->accountant($data);
    }


	/**
	 * admin template view 
	 * @param string view file 
	 * @param array $data
	 */
	protected function publicTemplate($view_file, $data)
	{
		$data['view_file'] = $view_file;
		$this->templates->public_bootstrap($data);
	}




	protected function adminSecurity()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
	}


	public function success_customer_choose_maid()
    {
        $this->publicTemplate('success_choose', $this->data);
    }


}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */